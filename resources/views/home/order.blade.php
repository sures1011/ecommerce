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
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Orders</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style type="text/css">
        .center{
            margin: auto;
            width: 60%;
            text-align: center;
            padding: 30px;

        }
        table,th,td{
            border: 1px solid grey;
        }
        .th_deg{
            font-size: 30px;
            padding: 5px;
            background: skyblue;
        }
        .img_deg{
            height: 100px;
            width: 100px;
        }
        .total_deg{
            padding: 30px;
        }
      </style>
   </head>
   <body>
      <div class="">
         <!-- header section strats -->
            @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         <div class="center">
        <table>
            <tr>
                <th class="th_deg">Product title</th>
                <th class="th_deg">Product Quantity</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Payment status</th>
                <th class="th_deg">Delivery Status</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Cancel Order</th>
            </tr>

            @foreach($order as $order)
            <tr>
                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>${{$order->price}}</td>
                <td>{{$order->payment_status}}</td>
                <td>{{$order->delivery_status}}</td>
                <td><img class="img_deg" src="/product/{{$order->image}}" alt=""></td>

                <td>
                @if($order->delivery_status=='processing')    
                <a onClick="return confirm('Do you want to cancel this order?')"href="{{url('cancel_order',$order->id)}}" class="btn btn-danger">Cancel</a>
                @else
                <p style="color:blue;">N/A</p>
                @endif

            </td>
                </tr>
            @endforeach

          

            
        </table>

        

      </div>
      </div>
      <!-- why section -->
      
      <!-- footer start -->
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