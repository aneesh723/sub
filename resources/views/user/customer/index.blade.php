@extends('user.layouts.app')

@section('extra_css')
<title>Customer</title>
<link rel="stylesheet" href="{{ asset('assets/bundles/izitoast/css/iziToast.min.css') }}">

@stop

@section('content')
    <div class="row">
 <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title mt-3">Customer List</h4>
               </div>
               <div class="card-body">
                <button href="" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#addCustomer">+ Customer</button>
                  <div class="table-responsive">
                     <table class=" table table-striped" id="descriptive-table">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Contact</th>
                              <th>Address</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
 </div>

 <!-- Add Model -->
           <div class="modal fade" id="addCustomer">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Customer</h5>
                        <button type="button" class="btn-close add_close" data-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addCustomerSubmit">
                            <div class="form-group mb-2">
                                <label>Name*</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label>Email*</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label>Contact*</label>
                                <input type="text" name="contact" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label>Address*</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

<!-- Edit Model -->
           <div class="modal fade" id="editCustomer">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Customer</h5>
                        <button type="button" class="btn-close add_close" data-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editCustomerSubmit">
                            <div class="form-group mb-2">
                                <label>Name*</label>
                                <input type="text" id="name" name="name" class="form-control">
                                <input type="hidden" name="id" id="custId">
                            </div>
                            <div class="form-group mb-2">
                                <label>Email*</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label>Contact*</label>
                                <input type="text" name="contact" id="contact" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label>Address*</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

<!-- Delete modal -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true" id="deleteCustomer" >
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Delete Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="deleteCustomerSubmit">
            <div class="modal-body">
               <p>Are you sure you want to delete this.....</p>
               <input type="hidden" name="id" id="custDeleteId">
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Delete</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </form>
              </div>
            </div>
          </div>
        </div>

@stop

@section('extra_js')
    <!-- JS Libraies -->
  <script src="{{ asset('assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/toastr.js') }}"></script>
  <script src="{{ asset('assets/js/common.js') }}"></script>
  <script>
  	$(document).ready(function(){

  		$('#descriptive-table').dataTable({

            pageLength:10,
            'serverSide':true,
            'checkboxes':{
                'selectRow':true,
            },

            "ajax":{
                url:"{{ route('customer.list') }}",
                "type": "get",
                'data':function(a) {
                    a._token = "{{ csrf_token() }}";
                },

                dataFilter: function(data) {
                    var table = jQuery.parseJSON(data);
                    table.recordsTotal = table.recordsTotal;
                    table.recordsFiltered = table.recordsFiltered;
                    table.data = table.data;

                    return JSON.stringify(table);
                }
            },

            "order":[[0, 'desc']],

            "columns": [{

                'target':0,
                'name':'id',
                'searchable':true,
                'orderable':false,
            },
            {

                'target':0,
                'name':'name',
                'searchable':true,
                'orderable':false,
            },
            {

                'target':1,
                'name':'email',
                'searchable':true,
                'orderable':false,
            },
            {

                'target':2,
                'name':'contact',
                'searchable':true,
                'orderable':false,
            },
            {

                'target':3,
                'name':'address',
                'searchable':true,
                'orderable':false,
            },
            {

                'target':4,
                'name':'action',
                'searchable':true,
                'orderable':false,
            },
            ]
        });

        $('#addCustomerSubmit').submit(function(edit) {

            edit.preventDefault();
            var editData = new FormData(this);
            editData.append('_token', "{{ csrf_token() }}");
            $.ajax({

                type: 'POST',
                url: "{{ route('add.customer') }}",
                data: editData,
                cache: false,
                processData: false,
                contentType: false,

                success: (data) => {

                    if (data.status == true) {

                        toastr.success(data.msg, 'Message', {

                            timeOut: 1000,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut',
                            tapToDismiss: 0
                        })

                        window.location.reload();
                    } else {

                        toastr.error(data.msg, 'Message', {

                            timeOut: 1000,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut',
                            tapToDismiss: 0
                        })
                    }
                },

                error: function(data) {

                    toastr.error(data.msg, 'Message', {
                        timeOut: 1000,
                        closeButton: !0,
                        progressBar: !0,
                        onclick: null,
                        showMethod: 'fadeIn',
                        hideMethod: 'fadeOut',
                        tapToDismiss: 0
                    })
                }
            });
        });

        $('body').on('click','.editModal',function(){
   
   			$('#editCustomer').modal('show')
   			$('#custId').val($(this).attr('data-id'));
   			$('#name').val($(this).attr('data-name'));
   			$('#email').val($(this).attr('data-email'));
   			$('#contact').val($(this).attr('data-contact'));
   			$('#address').val($(this).attr('data-address'));
   
   });

        $('#editCustomerSubmit').submit(function(edit) {

            edit.preventDefault();
            var editData = new FormData(this);
            editData.append('_token', "{{ csrf_token() }}");
            $.ajax({

                type: 'POST',
                url: "{{ route('edit.customer') }}",
                data: editData,
                cache: false,
                processData: false,
                contentType: false,

                success: (data) => {

                    if (data.status == true) {

                        toastr.success(data.msg, 'Message', {

                            timeOut: 1000,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut',
                            tapToDismiss: 0
                        })

                        window.location.reload();
                    } else {

                        toastr.error(data.msg, 'Message', {

                            timeOut: 1000,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut',
                            tapToDismiss: 0
                        })
                    }
                },

                error: function(data) {

                    toastr.error(data.msg, 'Message', {
                        timeOut: 1000,
                        closeButton: !0,
                        progressBar: !0,
                        onclick: null,
                        showMethod: 'fadeIn',
                        hideMethod: 'fadeOut',
                        tapToDismiss: 0
                    })
                }
            });
        });

        // delete

            $('body').on('click','.deleteModal',function(){
   
   $('#deleteCustomer').modal('show')
   $('#custDeleteId').val($(this).attr('data-id'))
   
   });

            $('#deleteCustomerSubmit').submit(function(edit) {

            edit.preventDefault();
            var editData = new FormData(this);
            editData.append('_token', "{{ csrf_token() }}");
            $.ajax({

                type: 'POST',
                url: "{{ route('delete.customer') }}",
                data: editData,
                cache: false,
                processData: false,
                contentType: false,

                success: (data) => {

                    if (data.status == true) {

                        toastr.success(data.msg, 'Message', {

                            timeOut: 1000,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut',
                            tapToDismiss: 0
                        })

                        window.location.reload();
                    } else {

                        toastr.error(data.msg, 'Message', {

                            timeOut: 1000,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut',
                            tapToDismiss: 0
                        })
                    }
                },

                error: function(data) {

                    toastr.error(data.msg, 'Message', {
                        timeOut: 1000,
                        closeButton: !0,
                        progressBar: !0,
                        onclick: null,
                        showMethod: 'fadeIn',
                        hideMethod: 'fadeOut',
                        tapToDismiss: 0
                    })
                }
            });
        });

  	});
  </script>
@stop