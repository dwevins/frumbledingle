<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $result = DB::select(
            '
                SELECT l.name AS location, p.name AS parent , c.name AS category, count(items.name) AS count
                FROM items
                LEFT JOIN locations l ON (items.location_id = l.id)
                LEFT JOIN categories c ON (items.category_id = c.id)
                LEFT JOIN categories p ON c.parent_id =
                    CASE 
                        WHEN c.parent_id IS NULL
                            then NULL
                        ELSE p.id
                    END
                WHERE l.deleted_at IS NULL
                AND c.deleted_at IS NULL
                AND p.deleted_at IS NULL
                GROUP BY l.name, c.name, p.name
                ORDER BY l.name
            '
        );

        return response()->json($result);
    }
}
