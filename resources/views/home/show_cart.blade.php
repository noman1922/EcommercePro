<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style type="text/css">
        .center
        {
            margin: auto;
            width: 50%;
            padding: 30px;
            text-align: center;
        }
        table, th, td
        {
            border: 1px solid grey;
        }
        .th_deg
        {
            font-size: 20px;
            padding: 5px;
            background: skyblue;
        }
       </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
        
         
   

      <div class="center">
        <table>
            <tr>
                <th>Product Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <?php $totalprice=0; ?>

            @foreach($cart as $cart)
            <tr style="background-color: skyblue; text-align: center;">
                <td>{{$cart->product_title}}</td>
                <td>{{$cart->quantity}}</td>
                <td>{{$cart->price}}</td>
                <td><img src="/product/{{$cart->image}}"></td>
                <td style="padding: 10px; font-size: 15px;">
                    <a class="btn btn-danger" href="{{url('remove_cart',$cart->id)}}" onclick="return confirm('Are you sure to delete this?')">Remove Product</a>
                </td>
            </tr>

            <?php $totalprice=$totalprice + $cart->price ?>
            @endforeach

            
        </table>
      </div>
      
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>