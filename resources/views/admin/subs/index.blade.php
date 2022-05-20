@extends('admin.layouts.app')

@section('extra_css')
<title>Subscriptions</title>
<link rel="stylesheet" href="{{ asset('assets/bundles/izitoast/css/iziToast.min.css') }}">

@stop

@section('content')
    <div class="row">
 <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title mt-3">Subscriptions List</h4>
               </div>
               <div class="card-body">
                <button href="" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target=".addCrud">+ Subscriptions</button>
                  <div class="table-responsive">
                     <table class=" table table-striped" id="descriptive-table">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Value</th>
                              <th>Amount</th>
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

 <div class="modal fade addCrud" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Manage Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="formSubmit">
                                            @csrf
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input id="name"  name="name" type="text" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Value</label>
                                                <input id="value" name="value" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input id="amount" min="0" step="any" name="amount" type="number" class="form-control">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-sm btn-info btn-block">
                                                    Submit
                                                </button>
                                            </div>
                                            <input type="hidden" name="id" id="subsId" />
                                        </form>
              </div>
            </div>
          </div>
        </div>
<!-- Delete modal -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true" id="deleteItem" >
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Delete Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="deleteCrudSubmit">
            <div class="modal-body">
               <p>Are you sure you want to delete this.....</p>
               <input type="hidden" name="id" id="subsDeleteId">
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
                url:"{{ route('subs.list') }}",
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
                'name':'value',
                'searchable':true,
                'orderable':false,
            },
            {

                'target':2,
                'name':'amount',
                'searchable':true,
                'orderable':false,
            },
            {

                'target':3,
                'name':'action',
                'searchable':true,
                'orderable':false,
            },
            ]
        });

            $('body').on('click','.editItem',function(){
   
   $('.addCrud').modal('show')
   $('#subsId').val($(this).attr('data-id'));
   $('#name').val($(this).attr('data-name'));
   $('#value').val($(this).attr('data-value'));
   $('#amount').val($(this).attr('data-amount'));
   
   });

            $('#formSubmit').submit(function(edit) {

            edit.preventDefault();
            var editData = new FormData(this);
            editData.append('_token', "{{ csrf_token() }}");
            $.ajax({

                type: 'POST',
                url: "{{ route('manage.subs.submit') }}",
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

            $('body').on('click','.deleteItem',function(){
   
   $('#deleteItem').modal('show')
   $('#subsDeleteId').val($(this).attr('data-id'))
   
   });

            $('#deleteCrudSubmit').submit(function(edit) {

            edit.preventDefault();
            var editData = new FormData(this);
            editData.append('_token', "{{ csrf_token() }}");
            $.ajax({

                type: 'POST',
                url: "{{ route('delete.subs.submit') }}",
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
