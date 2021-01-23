@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="sl-page-title">
            <h5>Filter Report</h5>
            </div><!-- sl-page-title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="modal-body pd-20">
                                <div class="form-group">
                                    <label for="day1">Từ ngày</label>
                                    <input  type="date" class="form-control" id="date1" name="date1" value="">
                                </div>
                                <div class="form-group">
                                    <label for="day2">Đến ngày</label>
                                    <input  type="date" class="form-control" id="date2" name="date2" value="">
                                </div>
                                <button onclick="search($('#date1').val(),$('#date2').val())" class="btn-sm btn-info">Xem</button>                                     
                        </div><!-- modal-body -->
                    </div><!-- card -->
                </div>
            </div><hr>
            <div class="row" id="form">
            <div class="col-lg-12">
                <div class="card">
                    <div class="table-wrapper pd-20">
                        <table id="table" class="table-striped w-auto table-bordered">
                            <thead>
                                <tr>
                                    <th class="wd-10p">Order ID</th>
                                    <th class="wd-15p">Product_name</th>
                                    <th class="wd-15p">Product_img</th>
                                    <th class="wd-15p">Payment Type</th>
                                    <th class="wd-15p">Total</th>
                                    <th class="wd-15p">Date</th>
                                    <th class="wd-15p">Status</th>
                                    <th class="wd-20p">Action</th>
                                </tr>
                                <tbody id="ritem">
                                    
                                </tbody>
                            </thead>
                        </table>
                    </div><!-- table-wrapper -->
                  </div><!-- card -->
            </div>
            </div>
        </div>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


    
<script type='text/javascript'>
    function search(date1,date2){
        $('#ritem').empty();
        let data = {
            date1 :date1,
            date2 :date2
        }
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'vnd',
            minimumFractionDigits: 0
        })
        $.ajax({           
            type: 'get',
            url: "{{url('admin/report/result')}}",
            data: data,
            traditional: true,
            dataType:"json",
            success:function(data){ 
                $.each(data.report,function(key,item){
                    var html = '<tr>';
                    html += '<td>'+item.id+'</td>';
                    html += '<td>'+item.product_name+'</td>';
                    //img
                    img = 'http://127.0.0.1:8000/'+item.image_one;
                    html += "<td><img style='width:60px;height:60px' src='"+img+"'></td>"
                    html += '<td>'+item.payment_type+'</td>';
                    html += '<td>'+formatter.format(item.total)+'</td>';
                    html += '<td>'+item.date+'</td>';
                    if(item.status == 0){
						html += "<td><span class='badge badge-warning'>Pending</span></td>"
                    }else if(item.status ==1){
						html += "<td><span class='badge badge-info'>payment accept</span></td>"
                    }else if(item.status ==2){
						html += "<td><span class='badge badge-warning'>Progress</span></td>"
                    }else if(item.status ==3){
						html += "<td><span class='badge badge-success'>Delevered</span></td>"
                    }else if(item.status ==4){
						html += "<td><span class='badge badge-danger'>Cancle</span></td>"
                    }
                    url='http://127.0.0.1:8000/admin/view/order/'+item.id;
                    html += '<td>'+"<a class='btn btn-info' href='"+url+"'>Xem</a></td></tr>'";
                    $('#ritem').prepend(html);
                });
                console.log(data);
            }
        });
    }

</script>

@endsection