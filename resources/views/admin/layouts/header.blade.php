<div class="row topnavi m-0">
	<div class="col-12 col-sm-5 col-md-5 headingtext text-left tcenter">
		
	</div>
	<div class="col-12 col-sm-7 col-md-7">
		<div class="row m-0">
			<div class="col-12 col-sm-6 col-md-6">			
			</div>
			<div class="col-12 col-sm-12 col-md-5 text-right">
				<ul class="navigatorlink">					
					<li class="dropdown profile-sec">
					<a href="#" class="dropdown-toggle" id="profile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-circle"></i> Hi,
				    {{Auth::user()->name}}
				</a>
					 <div class="dropdown-menu" aria-labelledby="profile"> 
						<a href="#">Change Password</a>
						<a href="{{ route('logout') }}">Logout</a>
					 </div>
					</li>
					
				</ul>
			</div>
		</div>

	</div>
</div>