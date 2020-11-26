@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Brand Update</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Brand Update</h6> <br>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('brand.update',$brand->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="brand_name"><b>Brand name</b></label>
                    <input type="text" name="brand_name" class="form-control" id="brand_name" value="{{$brand->brand_name}}">
                </div>	
                <div class="form-group">
                    <label> <b> Brand logo </b></label><br/>
					<img src="{{asset($brand->brand_logo)}}" id="avatar" class="thumbnail" width="80px" height="100px" alt="brand_logo"> </br></br>
                    <input id="img" type="file" accept="image/*" name="brand_logo" class="form-control" placeholder="Brand logo" onchange="previewImg(this)">
                    <input type="hidden" name="old_logo" class="form-control" value="{{$brand->brand_logo}}" onchange="previewImg(this)">
                </div>												
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    <a href="{{route('brands')}}" class="btn btn-secondary pd-x-20">Cancle</a>
                </div>
            </form>
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
	<!-- ########## END: MAIN PANEL ########## -->
	
@endsection