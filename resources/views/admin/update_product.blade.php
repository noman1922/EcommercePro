<!DOCTYPE html>
<html lang="en">
  <head>
    
    <!-- Required meta s -->
    @include('admin.css')
    <style type="text/css">
        .div_center
        {
            text-align: center;
            padding-top: 40px;
        }
        .h2_font
        {
            font-size: 40px;
            padding-bottom: 40px;
        }   
        .input_color
        {
            color: black;
        }
        .center
        {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
        }
        label
        {
            display: inline-block;
            width: 200px;
        }
        .div_design
        {
            padding-bottom: 15px;
        }
        .img_size
        {
            margin: auto;
            width: 150px;
            height: 150px;
        }
     </style>
  </head>
  <body>
    <div class="container-scroller">
   
      @include('admin.sidebar') 
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
      <div class="main-panel">
          <div class="content-wrapper">
            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>

          @endif
            <div class="div_center">
                <h2 class="h2_font">Update Product</h2>

                <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="div_design">
                <label>Product Title :</label>
                <input type="text" class="input_color" name="title" placeholder="Write a title" required="" value="{{ $product->title }}">
                </div>
                <div class="div_design">
                <label>Product Description :</label>
                <input type="text" class="input_color" name="description" placeholder="Write a description" required="" value="{{ $product->description }}">
                </div>
                <div class="div_design">
                <label>Product price :</label>
                <input type="number" class="input_color" name="price" placeholder="Write price" required=""  value="{{ $product->price }}">
                </div>
                <div class="div_design">
                <label>Discount Price:</label>
                <input type="number" class="input_color" name="discount_price" placeholder="Write discount" value="{{ $product->discount_price }}">

                </div>

                <div class="div_design">
                <label>Product Quantity :</label>
                <input type="number" min="0" class="input_color" name="quantity" placeholder="Write a quantity" required="" value="{{ $product->quantity }}">
                </div>
                
                <div class="div_design">
                <label>Product Catagory :</label>
                <select class="input_color" name="catagory" required="" >
                    <option value="{{ $product->catagory }}" selected="">{{ $product->catagory }}</option>
                     @foreach($catagory as $catagory)
                    <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                    @endforeach
                   

                </select>
                </div>

                <div class="div_design">
                <label>Current Product Image :</label>
                <img class="img_size"  src="/product/{{ $product->image }}">
                </div>

                <div class="div_design">
                <label>Change Product Image :</label>
                <input type="file"  name="image" value="{{ $product->image }}">
                </div>

                <div class="div_design">
                <input type="submit" class="btn btn-primary" value="Update Product" >
                </div>

                </form>

      </div>
      </div>
      </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>