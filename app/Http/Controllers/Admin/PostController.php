<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\BlogRequest;
use Image;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
   
    public function blogCateList(){
        $blogcate = DB::table('post_category')->get();
        return view('admin.blog.category.index',compact('blogcate'));
    }

    public function storeBlogCate(BlogRequest $request){
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_in'] = $request->category_name_in;
        DB::table('post_category')->insert($data);
        $notification=array(
            'message'=>'Blog Category Successfully Added !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);

    }
    public function deleteBlogCate($id){
        DB::table('post_category')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Blog Category Successfully Deleted !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
    public function editBlogCate($id){
        $blogCate = DB::table('post_category')->where('id',$id)->first();
        return view('admin.blog.category.edit_blog',compact('blogCate'));
    }

    public function updateBlogCate(BlogRequest $request){
        $data = array();
        $data['category_name_en'] = $request->category_name_en;
        $data['category_name_in'] = $request->category_name_in;
        DB::table('post_category')->update($data);
        $notification=array(
            'message'=>'Blog Category Successfully Update !',
            'alert-type'=>'success'
            );
        return Redirect()->route('blog.categorylist')->with($notification);
    }

    public function createPost(){
        $blogCate = DB::table('post_category')->get();
        return view('admin.blog.create',compact('blogCate'));
    }

    public function storePost(Request $request){
        $data = array();

        $data['post_title_in'] = $request->post_title_in;
        $data['post_title_en'] = $request->post_title_en;
        $data['detail_en'] = $request->detail_en;
        $data['detail_in'] = $request->detail_in;
        $data['category_id'] = $request->category_id;

        $post_image = $request->file('post_image');

        if($post_image){
            $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(350,250)->save('media/post/'.$post_image_name);
            $data['post_image'] = 'media/post/'.$post_image_name;
            DB::table('posts')->insert($data);
            $notification=array(
            'message'=>'Post Inserted Successfully !',
            'alert-type'=>'success'
            );

            return Redirect()->back()->with($notification);
        }else{
            $data['post_image'] = '';
            DB::table('posts')->insert($data);
            $notification=array(
            'message'=>'Post Inserted Without Image !',
            'alert-type'=>'success'
            );

            return Redirect()->back()->with($notification);
        }  
    }
    public function index(){
        $post = DB::table('posts')
            ->join('post_category','post_category.id','posts.category_id')
            ->select('posts.*','post_category.category_name_en')
            ->get();
            return view('admin.blog.index',compact('post'));
    }

    public function deletePost($id){
        $post = DB::table('posts')->find($id);
        unlink($post->post_image);
        DB::table('posts')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Post Deleted Success !',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    public function editPost($id){
        $post = DB::table('posts')->where('id',$id)->first();
        return view('admin.blog.edit',compact('post'));
    }

    public function updatePost(Request $request,$id){
        $old_image = $request->old_image;
        $data = array();
        $data['post_title_in'] = $request->post_title_in;
        $data['post_title_en'] = $request->post_title_en;
        $data['detail_en'] = $request->detail_en;
        $data['detail_in'] = $request->detail_in;
        $data['category_id'] = $request->category_id;

        $post_image = $request->file('post_image');

        if($post_image){
            unlink($old_image);
            $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(350,250)->save('media/post/'.$post_image_name);
            $data['post_image'] = 'media/post/'.$post_image_name;
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Post Updated Successfully !',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }else{
            $data['post_image'] = $old_image;
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Post Updated Without Image !',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }  
    }
}


