@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

      <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Coupon Update</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Coupon Update</h6> <br>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('coupon.update',$coupon->id)}}">
                @csrf
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <label>Coupon code</label>
                        <input type="text" name="coupon" class="form-control" placeholder="coupon" value="{{$coupon->coupon}}">
                    </div>
                    <div class="form-group">
                        <label>Coupon discount (%)</label>
                        <input type="text" name="discount" class="form-control" placeholder="discount" value="{{$coupon->discount}}">
                    </div>												
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    <a href="{{route('coupons')}}" class="btn btn-secondary pd-x-20">Cancle</a>
                </div>
            </form>
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
	<!-- ########## END: MAIN PANEL ########## -->
	
@endsection