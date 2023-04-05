@extends('admin.layouts.app')

@section('content')

<div class="col-12 col-md-12 col-sm-12">
    <div class="notification">Add Product
        <a href="{{route('admin.product')}}"><i class="fas fa-arrow-left backbtn"></i></a>
    </div>
    <div class="boxshadowcontainer">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
               <form action="{{ route('admin.product.store') }}" class="commonform" method="POST"
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
                        <div class="col-6 col-sm-6 col-md-6 form-group">
                           Product Category <span class="text-danger">*</span> 
                            <select name="product_category[]" class="form-control" multiple>
                                @foreach($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->title}}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="col-6 col-sm-6 col-md-6 form-group">
                           Product Name <span class="text-danger">*</span> 
                            <input type="text" class="form-control" placeholder="Product Name" value="{{ old('title') }}" id="" name="title" maxlength="200" />
                        </div> 
                        <div class="col-6 col-sm-6 col-md-6 form-group">
                           Featured Image <span class="text-danger">*</span> 
                            <input type="file" class="form-control" name="featured_image" />
                        </div> 
                        <div class="col-6 col-sm-6 col-md-6 form-group">
                           Gallery 
                            <input type="file" class="form-control" name="gallery[]" multiple />
                        </div>                        
                       
                         <fieldset class="formfieldset">
                            <legend >Product Description <span class="text-danger">*</span> </legend>
                         <!-- Summernote -->
                        <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 form-group">
                            <textarea id="description" placeholder="Product Description"  name="description" maxlength="3000" required>
                            {{ old('description') }}
                            </textarea>
                        </div> 

                        </fieldset>                   
                        
                        
                         
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 form-group text-center">
                            <button type="submit" class="btn btn-primary gradientbutton submitForm">Submit</button>                          
                        </div>
                    </div>


                </form>
            </div>
        </div>

    </div>
</div>
<script src="{{ asset('public/backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
 <script>
 
 function registerSummernote(element, placeholder, max, callbackMax) {
    $(element).summernote({
     
      placeholder,
      callbacks: {
        onKeydown: function(e) {
          var t = e.currentTarget.innerText;
          if (t.length >= max) {
            //delete key
            if (e.keyCode != 8)
              e.preventDefault();
            // add other keys ...
          }
        },
        onKeyup: function(e) {
          var t = e.currentTarget.innerText;
          if (typeof callbackMax == 'function') {
            callbackMax(max - t.length);
          }
        },
        onPaste: function(e) {
          // console.log(e);
          var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html');
              e.preventDefault();
              var div = $('<div />');
              div.append(bufferText);
              div.find('*').removeAttr('style');
              setTimeout(function () {
                document.execCommand('insertHtml', false, div.html());
            }, 10);
        }
      },

      height: 200
      
    });
  }


$(function(){
  registerSummernote('#description', 'Leave a comment', 3000, function(max) {
    $('#maxContentPost').text(max)
  });
});

</script> 
@endsection
