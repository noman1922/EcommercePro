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
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style type="text/css">
         .center
         {
            margin: auto;
            width: 70%;
            padding: 30px;
            text-align: center;
         }
           
         table,th,td
         {
            border: 1px solid black;
         }
         .th_deg
         {
            font-size: 20px;
            padding: 10px;
            background: skyblue;
            font-weight: bold;
         }
            .img_deg
            {
                height: 100px;
                width: 100px;
            }
        </style>


   </head>
   <body>
      
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->

         <div class="center">
            <table>
                <tr>
                    <th class="th_deg">Product Title</th>

                    <th class="th_deg">Quantity</th>

                    <th class="th_deg">Price</th>

                    <th class="th_deg">Payment Status</th>

                    <th class="th_deg">Delivery Status</th>

                    <th class="th_deg">Image</th>

                    <th class="th_deg">Cancel Order</th>

                </tr>

                <tr>
                    @foreach($order as $order)

                    <td>{{ $order->product_title }}</td>

                    <td>{{ $order->quantity }}</td>

                    <td>{{ $order->price }}</td>

                    <td>{{ $order->payment_status }}</td>

                    <td>{{ $order->delivery_status }}</td>

                    <td>
                        <img class="img_deg" src="/product/{{ $order->image }}">
                    </td>

                    <td>
                        @if($order->delivery_status=='processing')
                        <a href="{{ url('cancel_order', $order->id) }}" onclick="return confirm('Are you sure to cancel this order?')" class="btn btn-danger">Cancel Order</a>
                        @else
                        <p style="color: blue;">Not Allowed</p>
                        @endif
                </tr>
                @endforeach

            </table>








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