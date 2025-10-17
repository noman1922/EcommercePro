<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Order PDF</title>

  <style type="text/css">
  @page {
    size: A4;
    margin: 15mm;
  }

  body {
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    color: #222;
    background-color: #fff;
    margin: 0;
    padding: 0;
  }

  .title_deg {
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    padding: 8px 0 12px 0;
    border-bottom: 3px solid #0078d7;
    margin-bottom: 15px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
    margin-top: 10px;
    table-layout: fixed;
    word-wrap: break-word;
  }

  th, td {
    border: 1.5px solid #555;
    padding: 8px;
    text-align: center;
    vertical-align: middle;
  }

  th {
    background-color: #0078d7;
    color: white;
    font-weight: 600;
  }

  tr:nth-child(even) {
    background-color: #f3f6fa;
  }

  tr:nth-child(odd) {
    background-color: #ffffff;
  }

  img {
    height: 70px;
    width: 70px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #999;
    background-color: #fff;
  }

  .footer {
    text-align: center;
    font-size: 11px;
    color: #444;
    margin-top: 20px;
    border-top: 1px solid #777;
    padding-top: 6px;
  }
</style>

</head>
<body>
  <h1 class="title_deg">Order Details</h1>

  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Product Title</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Payment Status</th>
      <th>Delivery Status</th>
      <th>Image</th>
    </tr>

    <tr>
      <td>{{$order->name}}</td>
      <td>{{$order->email}}</td>
      <td>{{$order->phone}}</td>
      <td>{{$order->address}}</td>
      <td>{{$order->product_title}}</td>
      <td>{{$order->quantity}}</td>
      <td>{{$order->price}}</td>
      <td>{{$order->payment_status}}</td>
      <td>{{$order->delivery_status}}</td>
      <td>
        <img height="70" width="70" src="product/{{$order->image}}">
      </td>
    </tr>
  </table>

  <div class="footer">
    <p>E-commerce Pro By Abdullah Al Nomna khan | © {{ date('Y') }}</p>
  </div>
</body>
</html>
