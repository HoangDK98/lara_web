<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCateRequest;

use Psy\Command\ListCommand\FunctionEnumerator;
use App\Model\Admin\Category;
use Illuminate\Support\Facades\Validator;
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

    public function storeCategory(StoreCateRequest $request){
        // $validatedData = $request->validate([
        //     'category_name' => 'required|unique:categories|max:255',
        // ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $notification=array(
            'message'=>'Category Added Successfully !',
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
}
