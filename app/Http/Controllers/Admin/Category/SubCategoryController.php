<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\SubCategoryRequest;
use App\Model\Admin\Subcategory;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subCategory(){
        $category = DB::table('categories')->get();
        $subcate = DB::table('subcategories')
            ->join('categories','subcategories.category_id','categories.id')
            ->select('subcategories.*','categories.category_name')
            ->get();
        return view('admin.category.subcategory',compact('category','subcate'));
    }

    public function storeSubCategory(SubCategoryRequest $request){
        $subCate = new Subcategory();
        $subCate->category_id = $request->category_id;
        $subCate->subcategory_name = $request->subcategory_name;
        $subCate->save();
        $notification=array(
            'message'=>'Added Successfully !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    public function deleteSubCategory($id){
        SubCategory::find($id)->delete();
        $notification=array(
            'message'=>'Delete Successfully !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    public function editSubCategory($id){
        $category = DB::table('categories')->get();
        $subCate = DB::table('subcategories')->where('id',$id)->first();
        return view('admin.category.edit_subcategory',compact('category','subCate'));
    }

    public function updateSubCategory(SubCategoryRequest $request,$id){
        $subCate = SubCategory::find($id);
        $subCate->subcategory_name = $request->subcategory_name;
        $subCate->category_id = $request->category_id;
        $subCate->save();
        $notification=array(
            'message'=>'Update Successfully !',
            'alert-type'=>'success'
            );
        return Redirect()->route('sub.categories')->with($notification);
    }
}
