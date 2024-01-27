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

        <table class="table table-bordered">
        <tr class="table_thcolor">

            <th>Product Title</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Discount Price</th>
            <th>Product Quantity</th>
            <th>Catagory</th>
            
            <th width="280px">Action</th>
        </tr>
        @foreach ($product as $product)
        <tr>
            
            
            <td>{{ $product->title }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->discount_price }}</td>
            
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->catagory }}</td>            

            <td><img class="program_image" height="200px" width="200px" src="/product/{{ $product->image }}" ></td>
            <td>
                <form action="#" method="POST">
     
                   
      
                    <a class="btn btn-primary" href="{{url('update_product',$product->id)}}">Edit</a>
     
                    @csrf
                    
        
                    <a onclick="return confirm('Delete {{$product->title}} ?')"href="{{url('delete_product',$product->id)}}" class="btn btn-danger">Delete</a>
                </form>
            </td>
        </tr>
        @endforeach
        
    </table>
</div>
</div>



@include('admin.footer')

</body>
</html>

