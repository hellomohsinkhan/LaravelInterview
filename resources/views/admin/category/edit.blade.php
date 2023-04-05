@extends('admin.layouts.app')

@section('content')

<div class="col-12 col-md-12 col-sm-12">
    <div class="notification">Edit Category 
        <a href="{{route('admin.category')}}"><i class="fas fa-arrow-left backbtn"></i></a>
    </div>
    <div class="boxshadowcontainer">

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <form action="{{ route('admin.category.update', $category->id) }}" class="commonform" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-12 col-sm-3 col-md-3 form-group">
                            <label>Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{@$category->title}}" id="" name="category" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 form-group text-center">
                            <button type="submit" class="btn btn-primary gradientbutton">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
