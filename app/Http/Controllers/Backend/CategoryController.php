<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

    public function storeCategory(Request $request)
    {

        $attr = $request->validate([
            'category_name'      => 'required',
            'image'              => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
        ]);


        $images = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();

        $manager = new ImageManager(Driver::class);
        $image = $manager->read($images);

        $image->cover(370, 246);
        $image->save('upload/category_images/' . $name_gen);

        $save_url = 'upload/category_images/' . $name_gen;

        Category::insert([
            'category_name' => $attr['category_name'],
            'category_slug' => $request['category_slug'],
            'image'         => $save_url,
        ]);

        $notification = [
            'message'       => 'Category Inserted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('all.category')->with($notification);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'category_slug', $request->category_name);

        return response()->json(['category_slug' => $slug]);
    }
}
