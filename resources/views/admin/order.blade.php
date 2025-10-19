<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .title_deg
        {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
        }
        table_deg
        {
            border: 2px solid grey;
            width: 100%;
            margin: auto;
            text-align: center;
           
        }
        th
        {
            background-color: skyblue;
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

          <h1 class="title_deg">All Orders</h1>
          <table>
            <tr style="background-color: grey;">
                <th style="padding: 10px;">Name</th>
                <th style="padding: 10px;">Email</th>
                <th style="padding: 10px;">Phone</th>
                <th style="padding: 10px;">Address</th>
                <th style="padding: 10px;">Product Title</th>
                <th style="padding: 10px;">Quantity</th>
                <th style="padding: 10px;">Price</th>
                <th style="padding: 10px;">Payment Status</th>
                <th style="padding: 10px;">Delivery Status</th>
                <th style="padding: 10px;">Image</th>
                <th style="padding: 10px;">Delivered</th>
                <th style="padding: 10px;">Print PDF</th>
                <th style="padding: 10px;">Send Email</th>

            </tr>

            @foreach($order as $order)
            <tr align="center" style="background-color: black;">
                <td style="padding: 10px;">{{$order->name}}</td>
                <td style="padding: 10px;">{{$order->email}}</td>
                <td style="padding: 10px;">{{$order->phone}}</td>
                <td style="padding: 10px;">{{$order->address}}</td>
                <td style="padding: 10px;">{{$order->product_title}}</td>
                <td style="padding: 10px;">{{$order->quantity}}</td>
                <td style="padding: 10px;">{{$order->price}}</td>
                <td style="padding: 10px;">{{$order->payment_status}}</td>
                <td style="padding: 10px;">{{$order->delivery_status}}</td>
                <td style="padding: 10px;">
                    <img height="100" width="100" src="/product/{{$order->image}}">
                </td>
                <td style="padding: 10px;">
                   @if($order->delivery_status=='processing')
                    <a class="btn btn-primary" href="{{url('delivered', $order->id)}}" onclick="return confirm('Are You Sure This Product is delivered!!!')">Delivered</a>
                   @else
                    <p style="color: green;">Delivered</p>
                    @endif
                </td>
                <td style="padding: 10px;">
                    <a class="btn btn-secondary" href="{{url('print_pdf', $order->id)}}">Print PDF</a>
                </td>

                <td style="padding: 10px;">
                    <a class="btn btn-info" href="{{url('send_email', $order->id)}}">Send Email</a>
                </td>
             </tr>

            @endforeach
</div>
</div>

        
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>