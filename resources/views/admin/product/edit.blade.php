@extends('admin.layouts.app')

@section('content')

<div class="col-12 col-md-12 col-sm-12">
    <div class="notification">Category 
        <a href="{{route('admin.product')}}"><i class="fas fa-arrow-left backbtn"></i></a>
    </div>
    <div class="boxshadowcontainer">

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <form action="{{ route('admin.product.update', $product->id) }}" class="commonform" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    
                    <div class="col-6 col-sm-6 col-md-6 form-group">
                           Product Category <span class="text-danger">*</span> 
                            <select name="product_category[]" class="form-control" multiple>
                                @foreach($category as $cat)
                                <option value="{{$cat->id}}" @if(in_array($cat->id,$pcat)) selected @endif>{{$cat->title}}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="col-6 col-sm-6 col-md-6 form-group">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{@$product->title}}" id="" name="title" required />
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 form-group">
                           Featured Image <span class="text-danger">*</span> 
                            <input type="file" class="form-control" name="featured_image" />
                            <img src="/featured_image/{{$product->featured_image}}" width="50px" height="50px">
                        </div> 
                        <div class="col-6 col-sm-6 col-md-6 form-group">
                           Gallery <span class="text-danger">*</span> 
                            <input type="file" class="form-control" name="gallery[]" multiple />                            
                            @if($product->gallery)
                            @foreach(json_decode($product->gallery) as $img)
                            <img src="/gallery/{{$img}}" width="50px" height="50px">
                            @endforeach
                            @endif
                        </div>                        
                       
                         <fieldset class="formfieldset">
                            <legend >Product Description <span class="text-danger">*</span> </legend>
                         <!-- Summernote -->
                        <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 form-group">
                            <textarea id="description" placeholder="Product Description"  name="description" maxlength="3000" required>
                            {{ old('description') }}
                            {{@$product->description}}
                            </textarea>
                        </div> 

                        </fieldset>   
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
