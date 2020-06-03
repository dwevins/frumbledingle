<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::get());
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
