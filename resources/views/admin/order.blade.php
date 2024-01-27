<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.css')

  <style type="text/css">
    .div_center
    {
        text-align:center;
        padding-top: 40px;
    }    
    .h2_font{
        font-size: 40px;
        padding-bottom: 40px;
    }
    .input_color{
        color: black;
    }
    .table_center{
        margin: auto;
        width: 50%;
        text-align: center;
        margin-top: 30px;
        border: 3px;
        
    }
    label{
        display: inline-block;
        width: 200px;
    }
    .div_design{
        padding-bottom:10px;
    }
    .img_size{
        height: 150px;
        width: 150px;
    }
</style>
</head>

<body class="hold-transition sidebar-mini">
  
<div class="wrapper">
  @include('admin.navbar')
  @include('admin.sidebar')



  <div class="main-panel">
    <div class="content-wrapper">
    @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                {{session()->get('message')}}
            </div>
        @endif

        <div style="padding: 30px; ">
            <form action="{{url('search')}}" method="get">
                @csrf
                <input type="text" name="search" placeholder="Search">
                <input type="submit" value="search" class="btn btn-outline-primary">
            </form>
        </div>
        <table class="table table-bordered">
        <tr class="table_thcolor">

            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Product Title</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Payment Status</th>
            <th>Delivery Status</th>
            <th>Image</th>
            <th>Delivered</th>
         
            
            
        </tr>
        @forelse($order as $orders)
        <tr>
            <td>{{$orders->name}}</td>
            <td>{{$orders->email}}</td>
            <td>{{$orders->address}}</td>
            <td>{{$orders->phone}}</td>
            <td>{{$orders->product_title}}</td>
            <td>{{$orders->quantity}}</td>
            <td>${{$orders->price}}</td>
            <td>{{$orders->payment_status}}</td>
            <td>{{$orders->delivery_status}}</td>
            <td><img src="/product/{{$orders->image}}" class="img_size" alt=""></td>
            <td>
                @if($orders->delivery_status=='processing')
                <a href="{{url('delivered',$orders->id)}}" class="btn btn-primary" onClick="return confirm('Product delivered?')">Delivered</a>
                @else
                <p style="color: green;">Delivered</p>
                @endif

            </td>
        </tr>

        @empty
        <div>
            <tr>
                <td colspan="16">
                    No data found
                </td>
            </tr>
            
        </div>
        @endforelse
    
</div>
</div>



@include('admin.footer')

</body>
</html>

