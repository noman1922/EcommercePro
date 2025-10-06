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
                <h2 class="h2_font">Add Product</h2>

                <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="div_design">
                <label>Product Title :</label>
                <input type="text" class="input_color" name="title" placeholder="Write a title" required="">
                </div>
                <div class="div_design">
                <label>Product Description :</label>
                <input type="text" class="input_color" name="description" placeholder="Write a description" required="" >
                </div>
                <div class="div_design">
                <label>Product price :</label>
                <input type="number" class="input_color" name="price" placeholder="Write price" required="">
                </div>
                <div class="div_design">
                <label>Discount Price:</label>
                <input type="number" class="input_color" name="discount price" placeholder="Write discount" >
                </div>

                <div class="div_design">
                <label>Product Quantity :</label>
                <input type="number" min="0" class="input_color" name="quantity" placeholder="Write a quantity" required="">
                </div>
                
                <div class="div_design">
                <label>Product Catagory :</label>
                <select class="input_color" name="catagory" required="">
                    <option value="" selected="">--Select Catagory--</option>
                    @foreach($catagory as $catagory)
                    <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                    @endforeach

                </select>
                </div>

                <div class="div_design">
                <label>Product Image Here :</label>
                <input type="file"  name="image" required="">
                </div>

                <div class="div_design">
                <input type="submit" class="btn btn-primary" value="Add Product" >
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