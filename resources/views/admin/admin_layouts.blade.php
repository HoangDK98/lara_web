<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Admin Manage</title>

    <!-- vendor css -->
    <link href="{{asset('backend/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">

	<!-- //use tag input cdn -->
	<link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>

    <!-- toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <!-- Datatable css -->
    <link href="{{asset('backend/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/starlight.css')}}">
    <link href="{{asset('backend//lib/summernote/summernote-bs4.css')}}" rel="stylesheet">

    <!-- Login -->
    <link rel="icon" type="image/png" href="{{asset('backend/img/icons/favicon.ico')}}"/>
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('backend/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/css-hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/login.css')}}">
    
  </head>

  <body>

    @guest

    @else

  
      <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i>ADMIN</a></div>
    <div class="sl-sideleft">
      <div class="sl-sideleft-menu">
        <a href="{{asset('admin/home')}}" class="sl-menu-link {{ request()->is('admin/home')  ? 'active' : '' }}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="#" class="sl-menu-link {{ request()->is('admin/category*')  ? 'active' : '' }} {{ request()->is('admin/subcategory*')  ? 'active' : '' }} {{ request()->is('admin/brand*')  ? 'active' : '' }}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Category</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('categories')}}" class="nav-link {{ request()->is('admin/category*')  ? 'active' : '' }}">Category</a></li>
          <li class="nav-item"><a href="{{route('sub.categories')}}" class="nav-link {{ request()->is('admin/subcategory*')  ? 'active' : '' }}">Sub Category</a></li>
          <li class="nav-item"><a href="{{route('brands')}}" class="nav-link {{ request()->is('admin/brand*')  ? 'active' : '' }}">Brand</a></li>
        </ul>
        <a href="#" class="sl-menu-link {{ request()->is('admin/coupon')  ? 'active' : '' }}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Coupons</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('coupons')}}" class="nav-link {{ request()->is('admin/coupon')  ? 'active' : '' }}">Coupon</a></li>
        </ul>
        <a href="#" class="sl-menu-link {{ request()->is('admin/product/*')  ? 'active' : '' }}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Product</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('product.add')}}" class="nav-link {{ request()->is('admin/product/add')  ? 'active' : '' }}">Add product</a></li>
          <li class="nav-item"><a href="{{route('product.all')}}" class="nav-link {{ request()->is('admin/product/all')  ? 'active' : '' }}">All product</a></li>
        </ul>

        <a href="#" class="sl-menu-link {{ request()->is('admin/order/*')  ? 'active' : '' }}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Order</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.neworder')}}" class="nav-link {{ request()->is('admin/order/pending')  ? 'active' : '' }}">New Orders</a></li>
          <li class="nav-item"><a href="{{route('admin.order.accept')}}" class="nav-link {{ request()->is('admin/order/accept')  ? 'active' : '' }}">Order Accept</a></li>
          <li class="nav-item"><a href="{{route('admin.order.process')}}" class="nav-link {{ request()->is('admin/order/process')  ? 'active' : '' }}">Process Delivery</a></li>
          <li class="nav-item"><a href="{{route('admin.order.delivered')}}" class="nav-link {{ request()->is('admin/order/delivered')  ? 'active' : '' }}">Delivery Success</a></li>
          <li class="nav-item"><a href="{{route('admin.order.cancle')}}" class="nav-link {{ request()->is('admin/order/cancle')  ? 'active' : '' }}">Cancle Order</a></li>
        </ul>

        <a href="#" class="sl-menu-link {{ request()->is('admin/report/*')  ? 'active' : '' }}">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Reports</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.all.report')}}" class="nav-link {{ request()->is('admin/report/all')  ? 'active' : '' }}">View Report</a></li>
          <li class="nav-item"><a href="{{route('admin.search.report')}}" class="nav-link {{ request()->is('admin/report/search')  ? 'active' : '' }}">Filter Report</a></li>
        </ul>
        <!-- contact -->
        <a href="#" class="sl-menu-link {{ request()->is('admin/*/message')  ? 'active' : '' }}">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-contact-outline tx-24"></i>
            <span class="menu-item-label">Contact</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('new.message')}}" class="nav-link {{ request()->is('admin/new/message')  ? 'active' : '' }}">New message</a></li>
          <li class="nav-item"><a href="{{route('processed.message')}}" class="nav-link {{ request()->is('admin/processed/message')  ? 'active' : '' }}">Processed message</a></li>
          <li class="nav-item"><a href="{{route('all.message')}}" class="nav-link {{ request()->is('admin/all/message')  ? 'active' : '' }}">All message</a></li>
        </ul>

       

      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{Auth::user()->name}}<span class="hidden-md-down"></span></span>
              <!-- <img src="../img/img3.jpg" class="wd-32 rounded-circle" alt=""> -->
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li><a href="{{route('admin.password.change')}}"><i class="icon ion-ios-gear-outline"></i> Change Password</a></li>
                <li><a href="{{ route('admin.logout') }}"><i class="icon ion-power"></i> Sign Out</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
          <a id="btnRightMenu" href="" class="pos-relative">
            <i class="icon ion-ios-bell-outline"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger"></span>
            <!-- end: if statement -->
          </a>
        </div><!-- navicon-right -->
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->



	@php 
		$message = DB::table('contacts')->where('status',0)->orderBy('created_at','desc')->limit(3)->get();
		$order = DB::table('orders')->where('status',0)->orderBy('created_at','desc')->limit(3)->get();
	@endphp
    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Tin nhắn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Thông báo</a>
        </li>
      </ul><!-- sidebar-tabs -->

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
          <div class="media-list">
			<!-- loop starts here -->
			@foreach($message as $item)
            <a data-dismiss="tab" data-toggle="modal" data-target="#viewmessage" id="{{$item->id}}" onclick="proView(this.id)"  class="media-list-link">
              <div class="media">
                <div class="media-body">
                  <span class="mg-b-0 tx-medium tx-gray-800 tx-13"><i class="fe-phone"></i>{{$item->name}}<span>
                  <span class="d-block tx-11 tx-gray-500">
                      <?php 
                        $date1=date_create(date('Y-m-d H:i:s'));
                        $date2=date_create($item->created_at);
                        $diff=date_diff($date2,$date1);
                        $day = $diff->format('%a');
                        $hour = $diff->format('%h');
                        $minute = $diff->format('%i');
                        $seconds = $diff->format('%s');
                        if($day > 0){
                          echo $diff->format("%a ngày trước");
                        }else {
                          if($hour > 0){
                            echo $diff->format("%h giờ trước");
                          } else{
                            if($minute > 0){
                              echo $diff->format("%i phút trước");
                            } else{
                              echo $diff->format("%s giây trước");
                            }
                          }
                        }
                      ?>    
				            </span>
                  <p class="tx-13 mg-t-10 mg-b-0">{{substr($item->message,0,50)}} ......</p>
                </div>
              </div><!-- media -->
			</a>
			@endforeach
            <!-- loop ends here -->
          </div><!-- media-list -->
          <div class="pd-15">
            <a href="{{route('new.message')}}" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View All</a>
          </div>
        </div><!-- #messages -->

        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
          <div class="media-list">
			<!-- loop starts here -->
			@foreach($order as $item)
            <a href="{{route('admin.view.order',$item->id)}}" class="media-list-link read" >
              <div class="media pd-x-20 pd-y-15">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700">
					  <strong class="tx-medium tx-gray-800">
						  	You have new order 
						</strong><br>
            <small>Đơn thứ {{$item->id}}</small>
					</p>
                  <span class="tx-12">
						<?php 
							$date1=date_create(date('Y-m-d H:i:s'));
							$date2=date_create($item->created_at);
							$diff=date_diff($date2,$date1);
							$day = $diff->format('%a');
							$hour = $diff->format('%h');
							$minute = $diff->format('%i');
							$seconds = $diff->format('%s');
							if($day > 0){
								echo $diff->format("%a ngày trước");
							}else {
								if($hour > 0){
									echo $diff->format("%h giờ trước");
								} else{
									if($minute > 0){
										echo $diff->format("%i phút trước");
									} else{
										echo $diff->format("%s giây trước");
									}
								}
							}
						?> 
				  </span>
                </div>
              </div><!-- media -->
			</a>
			@endforeach
            <!-- loop ends here -->
		  </div><!-- media-list -->
		  <div class="pd-15">
            <a href="{{route('admin.neworder')}}" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View All</a>
          </div>
        </div><!-- #notifications -->

      </div><!-- tab-content -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->


    <div class="modal fade" id="viewmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" >
					<div class="row" >
						<div class="col-lg-6">
							<ul class="list-group">
								<li class="list-group-item">Name :<span id="name"></span> </li>
								<li class="list-group-item">Phone :<span id="phone"></span> </li>
								<li class="list-group-item">Email :<span id="email"></span> </li>
								<li class="list-group-item">Satus :<span id="status" class="badge"></span></li>
							</ul>
						</div>
						<div class="col-lg-6">
							<h6>Message</h6><br>
							<textarea rows="7" cols="30" id="content_message" disabled></textarea><br>
						</div>
					</div>
				</div>
				<div class="modal-footer" id="modal-foot">
								
				</div>
			</div>
		</div>
	</div>
    
    @endguest

    @yield('admin_content')

    <!-- login -->
    <script src="{{asset('backend/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!-- <script src="{{asset('backend/vendor/bootstrap/js/popper.js')}}"></script> -->
    <!-- <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.min.js')}}"></script> -->
    <script src="{{asset('backend/vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('backend/vendor/tilt/tilt.jquery.min.js')}}"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="{{asset('backend/js/login.js')}}"></script>
    <!-- end_login -->

    <script src="{{asset('backend/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('backend/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('backend/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('backend/lib/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
          <!-- Datatable -->
          <script src="{{asset('backend/lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('backend/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('backend/lib/select2/js/select2.min.js')}}"></script>
    <script>
      $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>

<!-- endatatable -->

    <script src="{{asset('backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('backend/lib/d3/d3.js')}}"></script>
    <script src="{{asset('backend/lib/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{asset('backend/lib/chart.js/Chart.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('backend/lib/flot-spline/jquery.flot.spline.js')}}"></script>
      <!-- summernote -->
    <script src="{{asset('backend/lib/medium-editor/medium-editor.js')}}"></script>
    <script src="{{asset('backend/lib/summernote/summernote-bs4.min.js')}}"></script>

    <script>
      $(function(){
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('#summernote').summernote({
          height: 150,
          tooltip: false
        })
      });
    </script>
    <script>
      $(function(){
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('#summernote1').summernote({
          height: 150,
          tooltip: false
        })
      });
    </script>
    <!-- end summernote -->
    <script src="{{asset('backend/js/starlight.js')}}"></script>
    <script src="{{asset('backend/js/ResizeSensor.js')}}"></script>
    <script src="{{asset('backend/js/dashboard.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>

    <script>
        @if(Session::has('message'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('message') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('message') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
        @endif
    </script>  

    <!-- preview img -->
    <script>
		$(window).on('resize', function() {
			if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function() {
			if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
		function previewImg(input) {
			if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#avatar')
				.attr('src', e.target.result)
				.width(100)
				.height(100);
			};
			reader.readAsDataURL(input.files[0]);
			}
		}
        
	</script>
	

     <script>  
         $(document).on("click", "#delete", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Are you Want to delete?",
                  icon: "warning", 
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } 
                });
            });
    </script>

<script type="text/javascript">
		function proView(id){
			$.ajax({
				url: "{{url('/admin/message/view/')}}/" + id, 
				type :"GET",
				dataType:"json",
				success:function(data){
					$('#name').text(data.message.name);
					$('#phone').text(data.message.phone);
					$('#email').text(data.message.email);
					if(data.message.status == 0){
						$('#status').empty();
						$('#modal-foot').empty();
						$('#status').append("<span class='badge' style='background:#ffc107;color:white'>pendding</span>");
            $('#modal-foot').append("<a href='http://127.0.0.1:8000/admin/process/message/"+data.message.id+"' class='btn btn-primary'>Xử lý</a>");
					}else{
						$('#status').empty();
						$('#modal-foot').empty();
						$('#status').append("<span class='badge' style='background:green;color:white'>processed</span>");
						$('#modal-foot').append("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
					}	
					$('#content_message').val(data.message.message);
				}
			})
		}
	</script>

  </body>
</html>
