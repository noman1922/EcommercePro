<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .center
        {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 40px;
            border: 2px solid white;
        }
        th
        {
            padding: 30px;
        }
        td
        {
            padding: 30px;
        }
        .font_size
        {
            font-size: 40px;
            padding-top: 20px;
            text-align: center;
        }
        .img_size
        {
            width: 150px;
            height: 150px;
        }
        .th_color
        {
            background: skyblue;
        }
     </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
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


          <h2 class=font_size>All Products</h2>
          <table class="center">
            <tr class="th_color">
                <th style="padding: 30px; font-size: 15px;">Product Title</th>
                <th style="padding: 30px; font-size: 15px;">Description</th>
                <th style="padding: 30px; font-size: 15px;">Quantity</th>
                <th style="padding: 30px; font-size: 15px;">Category</th>
                <th style="padding: 30px; font-size: 15px;">Price</th>
                <th style="padding: 30px; font-size: 15px;">Discount Price</th>
                <th style="padding: 30px; font-size: 15px;">Product Image</th>
                <th style="padding: 30px; font-size: 15px;">Delete</th>
                <th style="padding: 30px; font-size: 15px;">Edit</th>

            </tr>
            @foreach($product as $product)
            <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->catagory}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->discount_price}}</td>
                <td>
                    <img class="img_size" src="/product/{{$product->image}}">
                </td>
                <td>
                    <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this')" href="{{url('delete_product', $product->id)}}">Delete</a>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{url('update_product', $product->id)}}">Edit</a>
                </td>
                @endforeach
            </tr>
          </table>

</div>
</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>