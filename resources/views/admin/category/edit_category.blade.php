@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Category Update</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Category Update</h6> <br>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('category.update',$category->id)}}">
                @csrf
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label>Category name</label>
                        <input type="text" name="category_name" class="form-control" placeholder="Category" value="{{$category->category_name}}">
                    </div>												
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    <a href="{{route('categories')}}" class="btn btn-secondary pd-x-20">Cancle</a>
                </div>
            </form>
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
	<!-- ########## END: MAIN PANEL ########## -->
	
@endsection