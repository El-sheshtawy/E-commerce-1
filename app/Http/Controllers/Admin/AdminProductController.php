<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class AdminProductController extends Controller
{

    public function create()
    {
        $categories=Category::all();
        return view('site.admin.pages.products.create',compact('categories'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')){
           $image= $request->file('image');
           $imageName=time().'.'.$image->getClientOriginalExtension();
            Product::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'quantity'=>$request->quantity,
                'category'=>$request->category,
                'image'=>$imageName,
            ]);
            $image->move('product',$imageName);
        } else {
            Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'quantity' => $request->quantity,
                'category'=>$request->category,
            ]);
        }
       return redirect()->back()->with('add_message','The Product has been add successfully');
    }


    public function show()
    {
        $products=Product::all();
        return  view('site.admin.pages.products.show',compact('products'));
    }


    public function edit($id)
    {
        $product=Product::findOrFail($id);
        $categories=Category::all();
        return view('site/admin.pages.products.edit',compact('product','categories'));
    }


    public function update(Request $request,$id)
    {
        $product=Product::findOrFail($id);
        if ($request->hasFile('image')){
            $image= $request->file('image');
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $product->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'quantity' => $request->quantity,
                'category' => $request->category,
                'image' => $imageName,
            ]);
            $image->move('product', $imageName);
        }
        else {
            $product->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'quantity' => $request->quantity,
                'category' => $request->category,
                 ]);
             }
        return redirect()->route('products.show')->with('update_message','The Product has been updated successfully');
    }


    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->back()->with('delete_message','The product has been deleted successfully');
    }
}
