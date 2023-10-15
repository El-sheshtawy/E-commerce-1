<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Category;

class AdminCategoryController extends Controller
{

    public function index()
    {
        $categories=Category::all();
        return view('site.admin.pages.categories.index',compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        Category::create([
            'category_name'=>$request->category_name,
        ]);
        return redirect()->back()->with('add_message','The category has been added successfully');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index')->with('delete_message','The category has been deleted successfully');
    }
}
