<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

use Psy\Command\ListCommand\FunctionEnumerator;
use App\Model\Admin\Category;

class CategoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function category(){
        $category = Category::all();
        return view('admin.category.category',compact('category'));
    }

    public function storeCategory(CategoryRequest $request){

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $notification=array(
            'message'=>'Added Successfully !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
    public function deleteCategory(){
        Category::where('id',request()->id)->delete();
        $notification=array(
            'message'=>'Delete Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);
    }

    public function editCategory(){
        $category = Category::where('id',request()->id)->first();
        return view('admin.category.edit_category',compact('category'));
        
    }
    public function updateCategory(CategoryRequest $request,$id){
        $category = Category::where('id',$request->id)->first();
        $category->category_name = $request->category_name;
        $category->update();
        $notification=array(
            'message'=>'Update Successfully !',
            'alert-type'=>'success'
        ); 
        return Redirect()->route('categories')->with($notification);
    }
}
