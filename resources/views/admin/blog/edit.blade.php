@extends('admin.admin_layouts')

@section('admin_content')

@php 
    $blogCate = DB::table('post_category')->get();
@endphp
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
		<nav class="breadcrumb sl-breadcrumb">
			<a class="breadcrumb-item" href="index.html">Starlight</a>
			<span class="breadcrumb-item active">Blog Section</span>
		</nav>

		<div class="sl-pagebody">
			<div class="card pd-20 pd-sm-40">
				<h6 class="card-body-title">Post Update
					<a href="{{route('all.post')}}" class="btn btn-primary btn-sm pull-right">All Post</a>
				</h6> </br>
				<form method="post" action="{{route('update.post',$post->id)}}" enctype="multipart/form-data">
				@csrf
					<div class="form-layout">
						<div class="row mg-b-25">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="post_title_en" class="form-control-label">Post Title (English) : <span class="tx-danger">*</span></label>
									<input id="post_title_en" class="form-control" type="text" name="post_title_en" value="{{$post->post_title_en}}" >
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group">
									<label for="post_title_in" class="form-control-label">Post Title (Hindi) : <span class="tx-danger">*</span></label>
									<input id="post_title_in" class="form-control" type="text" name="post_title_in" value="{{$post->post_title_in}}">
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-4">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Blog Category: <span class="tx-danger">*</span></label>
									<select class="form-control select2" data-placeholder="Choose category" name="category_id">
										<option label="Choose country"></option>
										@foreach($blogCate as $item)
										<option value="{{$item->id}}" <?php if($item->id == $post->category_id){echo "selected" ;}?>>
                                        {{$item->category_name_en}}</option>
										@endforeach
									</select>
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Product Detail (English): <span class="tx-danger">*</span></label>
									<textarea class="form-control" id="summernote" name="detail_en">
                                        {{!! $post->detail_en !!}}
                                    </textarea>
								</div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Product Detail (Hindi): <span class="tx-danger">*</span></label>
									<textarea class="form-control" id="summernote1" name="detail_in">
                                    {{!! $post->detail_in !!}}
                                    </textarea>
								</div>
							</div><!-- col-4 -->
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<label class="form-control-label">Post Image<span class="tx-danger">*</span></label>
									<label class="custom-file">
										<input type="file" id="img" class="custom-file-input" name="post_image" accept="image/*" onchange="previewImg(this);">
                                        <span class="custom-file-control"></span>
									</label>
                                </div class="col-lg-6 col-md-6">
                                    <br><img src="{{asset($post->post_image)}}" id="avatar" width="100px" height="100px">
									<input type="hidden" value="{{$post->post_image}}" name="old_image">
                                <div >

                                </div>
							</div><!-- col-4 -->	
						</div> <!-- row -->
                        <hr><br>
					</div><!-- form-layout --><br><br>
					<div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5">Post</button>
						<a href="{{route('add.post')}}" type="button" class="btn btn-secondary pd-x-20" >Cancle</a>
					</div><!-- form-layout-footer -->
				</form>
			</div><!-- card -->
		</div>

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


@endsection
