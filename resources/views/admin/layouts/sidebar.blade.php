<div class="col-12 co-sm-2 col-md-2 p-0 sidebar-nav">
    <div class="indianlogo tcenter">
        <a href="{{route('admin.dashboard')}}" title="Ministry of Tourism"><img
                src="{{ asset('backend/images/logo.png') }}" class="img-fluid"
                /></a>
    </div>      
    <ul class="sidenavi">   
		<li class="">
			<a href="{{route('admin.dashboard')}}"><i class="fas fa-users"></i> Application Users</a>
		</li>	
        <li class="">
            <a href="{{route('admin.category')}}"><i class="fas fa-ticket-alt"></i> Category</a>
        </li>
        <li class="">
            <a href="{{route('admin.product')}}"><i class="fas fa-ticket-alt"></i> Product</a>
        </li>	
		</ul>
</div>