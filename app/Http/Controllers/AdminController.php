<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

use PhpParser\Node\Stmt\Catch_;
use Session;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = category::all();
        return view('admin.category', compact('data'));
    }
    public function add_category(Request $request)
    {

        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
        session()->flash('success', 'Data has been inserted successfully!');

        return redirect()->back();
    }
    public function delete_category($id)
    {
        $data = category::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = category::find($id);
        return view('admin.edit_category', compact('data'));
    }
    public function update_category(Request $request, $id)
    {
        $data = category::find($id);
        $data->category_name = $request->category;
        $data->save();
        return redirect('/view_category');
    }

    //   Product section controller action
    public function add_product()
    {
        $category = category::all();
        return view('admin.add_product', compact('category'));
    }
    public function upload_product(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $data->image = $imagename;
        }

        $data->price = $request->price;
        $data->category = $request->category;
        $data->quantity = $request->quantity;
        $data->save();
        return redirect()->back();
    }
    public function view_product()
    {
        $products = Product::paginate(4);
        return view('admin.view_product', compact('products'));
    }
    public function delete_product($id)
    {
        $data = Product::find($id);
        $image_path = public_path('products/'.$data->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $data->delete();
        return redirect()->back();
    }
    public function edit_product($id)
    {
        $product = Product::find($id);
        $categories = Category::all(); // Fetch all categories from the database

        return view('admin.edit_product', compact('product', 'categories'));
    }
    public function update_product(Request $request, $id)
    {
        $data = Product::find($id);
        if (!$data) {
            return redirect()->back()->withErrors('Product not found.');
        }

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->quantity = $request->quantity;

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('products', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        return redirect('/view_product')->with('success', 'Product updated successfully.');
    }
    // searce product method
     public function product_search(Request $request){
        $search = $request->search;
        $products = Product::where('title','LIKE','%'.$search.'%')->
        orWhere('category','LIKE','%'.$search.'%')->paginate(4);
        return view('admin.view_product',compact('products'));
     }
    //  Order method
    public function view_order(){
        $data = Order::all();

        return view('admin.view_order',compact('data'));
    }

    public function on_the_way($id){
        $data = Order::find($id);
        $data->status = 'On the Way';
        $data->save();

        return redirect('view_order');
    }
    public function delivered($id){
        $data = Order::find($id);
        $data->status = 'Delivered';
        $data->save();
        return redirect('view_order');
    }



}
