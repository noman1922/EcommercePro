<!DOCTYPE html>
<html>
   <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        .center {
    margin: 50px auto;
    width: 80%;              /* wider for better balance */
    max-width: 900px;        /* prevent it from stretching too much */
    padding: 30px;
    text-align: center;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid grey;
}

.th_deg {
    font-size: 20px;
    padding: 10px;
    background: skyblue;
}

td {
    padding: 10px;
    vertical-align: middle;
}

td img {
    width: 120px;         /* fixed image size */
    height: auto;
    border-radius: 10px;
    object-fit: cover;
}

/* Make table responsive for mobile */
@media (max-width: 768px) {
    .center {
        width: 95%;
        padding: 15px;
    }

    .th_deg {
        font-size: 16px;
        padding: 6px;
    }

    td {
        font-size: 14px;
        padding: 6px;
    }

    td img {
        width: 80px;
    }
}
   

       </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')

         @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>

          @endif
        
         
   

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
                    <a class="btn btn-danger" href="{{url('remove_cart',$cart->id)}}" onclick="confirmation(event)">Remove Product</a>
                </td>
            </tr>

            <?php $totalprice=$totalprice + $cart->price ?>
            @endforeach



            
        </table>
        <div>
            <h1 style="font-size: 20px; padding: 40px;">Total Price: {{$totalprice}}.00</h1>
      </div>
      <h1 style="font-size: 25px; padding-bottom: 15px;">
            Proceed to Order
        </h1>
        <a href="{{url('cash_order')}}" class="btn btn-danger">Cash on Delivery</a>
        <a href="{{url('stripe',$totalprice)}}" class="btn btn-danger">Pay Using Card</a>
        </div>
      
     
      <!-- footer end -->
      

      <script>
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure to cancel this product",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {


                 
                window.location.href = urlToRedirect;
               
            }  


        });

        
    }
</script>
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