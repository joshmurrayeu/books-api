<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoriesController extends Controller
{
    public function index(Request $request, Category $category)
    {
        return CategoryResource::collection($category->all());
    }
}
