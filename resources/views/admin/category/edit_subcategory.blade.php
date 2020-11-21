@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          	<h5>Sub Category Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('subcategory.update',$subCate->id)}}"> 
                @csrf
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <labe><b>Sub Category Name</b></label>
                        <input type="text" name="subcategory_name" class="form-control" value="{{$subCate->subcategory_name}}">
                    </div>	
                    <div class="form-group">
                        <label><b>Category Name</b></label>
                        <select class="form-control" name="category_id">        
                            @foreach($category as $item)
                                <option value="{{$item->id}}">{{$item->category_name}} </option>
                            @endforeach
                        </select>
                    </div>											
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    <a href="{{route('sub.categories')}}" class="btn btn-danger">Cancle</a>
                </div>
            </form>
      	</div><!-- card -->
      </div>
    </div><!-- sl-mainpanel -->
	<!-- ########## END: MAIN PANEL ########## -->

@endsection

