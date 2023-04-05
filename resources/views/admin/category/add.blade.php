@extends('admin.layouts.app')

@section('content')

<div class="col-12 col-md-12 col-sm-12">
    <div class="notification">Add Category
        <a href="{{route('admin.category')}}"><i class="fas fa-arrow-left backbtn"></i></a>
    </div>
    <div class="boxshadowcontainer">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                
                <form action="{{ route('admin.category.store') }}" class="commonform" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="display: grid;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                    <div class="col-12 col-sm-4 col-md-4 form-group">
                            <label>Category Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="" id="" name="category" required />
                        </div>	
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 form-group text-center">
                            <button type="submit" class="btn btn-primary gradientbutton">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection