<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $response = DB::table('items')
            ->join('locations as L', 'items.location_id', '=', 'L.id')
            ->join('categories as C', 'items.category_id', '=', 'C.id')
            ->join('categories as P', 'C.parent_id', '=', 'P.id')
            ->selectRaw('L.name as location, P.name as parent, C.name as category, count(items.name) as count')
            ->whereNull('L.deleted_at')
            ->whereNull('C.deleted_at')
            ->whereNull('P.deleted_at')
            ->groupBy('L.name', 'C.name', 'P.name')
            ->orderBy('L.name', 'asc')
            ->get();

        
        return response()->json($response);
    }
}

// select l.name as Location, parent.name as 'Parent Category' , c.name as Category, count(items.name) as Count
// from items
// left join locations l on (items.location_id = l.id)
// left join categories c on (items.category_id = c.id)
// left join categories parent on c.parent_id =
// 	case 
// 		when c.parent_id is null
// 			then null
// 		else parent.id
// 		end
// group by l.name, c.name, c.parent_id
// order by l.name;
