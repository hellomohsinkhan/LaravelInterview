@extends('admin.layouts.app')

@section('content')
<div class="col-12 col-md-12 col-sm-12">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="notification">Product List <a href="{{route('admin.dashboard')}}"><i
                        class="fas fa-arrow-left backbtn"></i></a></div>

        </div>
        <div class="clearfix"></div>
        
        <div class="col-md-12 mt-2">
            @if (session('success'))
            <div class="alert alert-success" id="validate">
                {{ session('success') }}
            </div>
            @endif
           
        </div>
        <div class="col-sm-12 col-md-12">
        
            <div class="text-right mt-2 buttonrow">
                <a href="{{route('admin.product.add')}}" class="btn btn-primary gradientbutton">Add Product</a>
            </div>
            <table class="table table-striped table-bordered nowrap customtable" id="product">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Product Name</th>
                        <th>Product Slug</th>
                        <th>Product Description</th>
                        <th>Created On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    var list = '{{ route("admin.product") }}';
	var titleName = 'Product List';
$(document).ready(function() {
    table_schedule(list)
});
function table_schedule(list) {
var tableid = 'product';
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
            "data": "title"
        },
        {
            "data": "slug"
        },
        {
            "data": "description"
        },
        {
            "data": "created_at"
        },
        {
            "data": "status"
        },        
        {
            "data": "action"
        }

    ],
    'columnDefs': [ { orderable: false, targets: [4,5,6] } ],
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
        url: "{{ route('admin.product.delete') }}",
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