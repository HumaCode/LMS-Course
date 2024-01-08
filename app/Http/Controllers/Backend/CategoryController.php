<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
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

        $image->resize(370, 246);
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

    public function editCategory($slug)
    {
        $title      = 'Edit Category';
        $subtitle   = 'edit category';
        $category   = Category::where('category_slug', $slug)->first();

        return view('admin.backend.category.edit_category', compact('title', 'subtitle', 'category'));
    }

    public function updateCategory(Request $request)
    {

        $id = $request->id;
        $data = Category::findOrFail($id);

        $attr = $request->validate([
            'category_name'      => 'required',
            'image'              => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        if ($request->file('image')) {

            // unlink foto
            if ($data->image <> "") {
                unlink($data->image);
            }

            $images = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($images);

            $image->resize(370, 246);
            $image->save('upload/category_images/' . $name_gen);

            $save_url = 'upload/category_images/' . $name_gen;

            $data->update([
                'category_name' => $attr['category_name'],
                'category_slug' => $request['category_slug'],
                'image'         => $save_url,
            ]);
        } else {
            $data->update([
                'category_name' => $attr['category_name'],
                'category_slug' => $request['category_slug'],
            ]);
        }

        $notification = [
            'message'       => 'Category Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('all.category')->with($notification);
    }

    public function deleteCategory($slug)
    {

        $data = Category::where('category_slug', $slug)->first();

        unlink($data->image);

        $data->delete();

        $notification = [
            'message'       => 'Category Deleted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'category_slug', $request->category_name);

        return response()->json(['category_slug' => $slug]);
    }



    // ---------------------Sub Category Manage -----------------------//

    public function allSubCategory()
    {
        $title          = 'All Sub Category';
        $subtitle       = 'all sub category';
        $subcategory    = SubCategory::with('category')->latest()->get();

        return view('admin.backend.subcategory.all_subcategory', compact('subcategory', 'title', 'subtitle'));
    }

    public function addSubCategory()
    {
        $title          = 'Add Sub Category';
        $subtitle       = 'add sub category';
        $category       = Category::latest()->get();


        return view('admin.backend.subcategory.add_subcategory', compact('category', 'title', 'subtitle'));
    }

    public function storeSubCategory(Request $request)
    {
        $attr = $request->validate([
            'category_id'           => 'required',
            'subcategory_name'      => 'required',
            'subcategory_slug'      => 'required|unique:sub_categories,subcategory_slug',
        ]);

        SubCategory::insert([
            'category_id'           => $attr['category_id'],
            'subcategory_name'      => $attr['subcategory_name'],
            'subcategory_slug'      => $attr['subcategory_slug'],
        ]);

        $notification = [
            'message'       => 'Sub Category Inserted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function editSubCategory($slug)
    {
        $title          = 'Edit Sub Category';
        $subtitle       = 'edit sub category';
        $category       = Category::latest()->get();
        $subcategory    = SubCategory::where('subcategory_slug', $slug)->first();


        return view('admin.backend.subcategory.edit_subcategory', compact('category', 'subcategory', 'title', 'subtitle'));
    }
    
    public function updateSubCategory(Request $request)
    {
        $id = $request->id; 
        $data = SubCategory::findOrFail($id);


        $attr = $request->validate([
            'category_id'           => 'required',
            'subcategory_name'      => 'required',
            'subcategory_slug'      => 'required|unique:sub_categories,subcategory_slug, ' . $id,
        ]);

        $data->update([
            'category_id'           => $attr['category_id'],
            'subcategory_name'      => $attr['subcategory_name'],
            'subcategory_slug'      => $attr['subcategory_slug'],
        ]);

        $notification = [
            'message'       => 'Sub Category Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function deleteSubCategory($slug)
    {

        $data = SubCategory::where('subcategory_slug', $slug)->first()->delete();

        $notification = [
            'message'       => 'Sub Category Deleted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }


    public function checkSlugSubCategory(Request $request)
    {
        $slug = SlugService::createSlug(SubCategory::class, 'subcategory_slug', $request->subcategory_name);

        return response()->json(['subcategory_slug' => $slug]);
    }
}
