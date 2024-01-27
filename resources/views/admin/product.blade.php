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

            <div class="div_center">
                <h2 class="h2_font">Add Product</h2>
                <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="div_design">
                    <label>Product Title: </label>
                    <input type="text" name="title" placeholder="Write the title" class="input_color" required="">
                    </div>

                    <div class="div_design">
                    <label>Product Description: </label>
                    <input type="text" name="detail" placeholder="Write the description" class="input_color" required="">
                    </div>

                    <div class="div_design">
                    <label>Product Price: </label>
                    <input type="number" name="price"  class="input_color" required="">
                    </div>

                    <div class="div_design">
                    <label>Discount Price: </label>
                    <input type="number" name="disc_price" class="input_color">
                    </div>

                    <div class="div_design">
                    <label>Product Quantity: </label>
                    <input type="number" name="quantity" class="input_color" required="">
                    </div>

                    <div class="div_design">
                    <label>Product Catagory: </label>
                    <select name="catagory" class="text_color">
                        
                        <option value="" selected>select</option>
                        @foreach($catagory as $catagory)
                        <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="div_design">
                    <label>Product Image: </label>
                    <input type="file" name="image" required="">
                    </div>

                    <input type="submit" class="btn btn-primary text_color"name="submit" value="Add Product">
                </form>
            </div>
            
            
                
        </div>
</div>


</div>


@include('admin.footer')

</body>
</html>

