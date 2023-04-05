@extends('admin.layouts.app')
@section('content')
<div class="col-sm-12 col-md-12">
    <div class="generatedemand">
        <div class="boxshadowcontainer">
            <div class="table-reponsive">
            <table class="table table-striped table-bordered nowrap customtable" id="user">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Create Date</th>                          
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
@endsection
@push('script')
<script>
    var list = '{{ route("admin.dashboard") }}';
    var titleName = 'User List';
$(document).ready(function() {
    table_schedule(list)
});
function table_schedule(list) {
var tableid = 'user';
var table = $('#' + tableid).DataTable({
    'responsive': true, // Table pagination
    "processing": true,
    "serverSide": true,
    "bDestroy": true,
    "bLengthChange": false,
    'dom': 'lBfrtip', // Bottom left status text
    "bAutoWidth": false,
    "bScrollCollapse": true,
    "bFilter": true,
    "order": [[ 0, "desc" ]],   
    "ajax": {
        "url": list,
        "type": "GET",
        'dataType':"json",
        data: function(d) {
            d._token = "{{ csrf_token() }}";
            d.level = 1;
        },
    },
    "columns": [

        {
            "data": "id",
            "orderable": false
        },
        {
            "data": "firstname"
        },
        {
            "data": "lastname"
        },
        {
            "data": "email"
        },
        {
            "data": "phone_number"
        },
        {
            "data": "created_at"
        },        
        {
            "data": "action"
        }

    ],
    'columnDefs': [ { orderable: false, targets: [5,6] } ],  

});
/*  */
}
$(document).on('click', '.deletedata', function() {
     var id=$(this).attr('data-value');
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
       $.ajax({
        url: "{{ route('admin.user.delete') }}",
        method: "POST",
        dataType: 'json',
        data: {
            'id': id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            table_schedule(list);
                Swal.fire(
                'Deleted!',
                'Record Deleted Successfully..',
                'success'
                )
                
        }
    });
   
  }
})
    
});
</script>
@endpush