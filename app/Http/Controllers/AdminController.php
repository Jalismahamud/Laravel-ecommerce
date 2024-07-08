<?php

namespace App\Http\Controllers;
use App\Models\category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use Session;

class AdminController extends Controller
{
   public function view_category(){
    $data = category::all();
    return view('admin.category',compact('data'));
   }
   public function add_category(Request $request){

    $category = new Category;
    $category->category_name = $request->category;
    $category->save();
    session()->flash('success', 'Data has been inserted successfully!');

    return redirect()->back();
   }
   public function delete_category($id){
     $data = category::find($id);
     $data->delete();
     return redirect()->back();
   }

   public function edit_category($id){
    $data = category::find($id);
    return view('admin.edit_category',compact('data'));
   }
   public function update_category(Request $request ,$id){
    $data = category::find($id);
    $data->category_name = $request->category;
    $data->save();
    return redirect('/view_category');
   }

}
