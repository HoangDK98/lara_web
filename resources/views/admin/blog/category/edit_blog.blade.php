@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Edit Blog Category</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update Blog Category </h6> <br>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('blog.category.update',$blogCate->id)}}">
                @csrf
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label>Category Name English</label>
                        <input type="text" name="category_name_en" class="form-control" placeholder="BLog Category Enlish " value="{{$blogCate->category_name_en}}">
                    </div>	
                    <div class="form-group">
                        <label>Category Name Hindi</label>
                        <input type="text" name="category_name_in" class="form-control" placeholder="Blog Category Hindi" value="{{$blogCate->category_name_in}}">
                    </div>												
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    <a href="{{route('blog.categorylist')}}" class="btn btn-secondary pd-x-20">Cancle</a>
                </div>
            </form>
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
	<!-- ########## END: MAIN PANEL ########## -->
	
@endsection