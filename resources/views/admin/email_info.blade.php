<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
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
            font-size: 25px
            font-width: bold;
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

          <h1 style="text-align: center; font-size: 25px;">Send Email to {{ $order->email }}</h1>

          <div style="padding-left: 35%; padding-top: 30px;">
            <form action="{{url('send_user_email', $order->id)}}" method="POST">
                @csrf
                <div style="padding: 15px;">
                    <label>Greeting</label>
                    <input type="text" style="color: black;" name="greeting">
                </div>
                <div style="padding: 15px;">
                    <label>Firstline</label>
                    <input type="text" style="color: black;" name="firstline">
                </div>
                <div style="padding: 15px;">
                    <label>Body</label>
                    <input type="text" style="color: black;" name="body">
                </div>
                <div style="padding: 15px;">
                    <label>Button Name</label>
                    <input type="text" style="color: black;" name="button">
                </div>
                <div style="padding: 15px;">
                    <label>Url</label>
                    <input type="text" style="color: black;" name="url">
                </div>
                <div style="padding: 15px;">
                    <label>Lastline</label>
                    <input type="text" style="color: black;" name="lastline">
                </div>
                <div style="padding: 15px;">
                    
                    <input type="submit" class="btn btn-primary" value="Send Email">
                </div>

            </form>


          </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>