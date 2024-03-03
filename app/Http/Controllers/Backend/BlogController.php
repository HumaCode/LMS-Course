<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function adminBlogCategory()
    {
        $title      = 'Blog Category';
        $subtitle   = 'blog category';
        $categories = BlogCategory::latest()->get();

        return view('admin.backend.blogcategory.blog_category', compact('title', 'subtitle', 'categories'));
    }
}
