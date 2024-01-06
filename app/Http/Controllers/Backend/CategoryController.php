<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $title      = 'All Category';
        $subtitle   = 'all category';
        $category   = Category::latest()->get();

        return view('admin.backend.category.all_category', compact('category', 'title', 'subtitle'));
    }

    public function addCategory()
    {
        $title      = 'Add Category';
        $subtitle   = 'add category';

        return view('admin.backend.category.add_category', compact('title', 'subtitle'));
    }
}
