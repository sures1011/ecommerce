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



  <div class="content-wrapper">
            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                {{session()->get('message')}}
            </div>

            @endif

            <div class="div_center">
                <h2 class="h2_font">Add Catagory</h2>
                <form action="{{url('/add_catagory')}}" method="POST" >
                    @csrf
                    <div class="div_design">
                    <label>Catagory Title: </label>
                    <input type="text" name="catagory" placeholder="Write the title" class="input_color">
                    </div>

                    

                    <input type="submit" class="btn btn-primary " name="submit" value="Add Catagory">
                </form>
            </div>
            
            
                
    <br>
        
        
       

        <table class="table table-bordered">
        <tr class="table_thcolor">

            <th>Name</th>
            
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $data)
        <tr>
            
            
            <td>{{ $data->catagory_name }}</td>
            
            <td>
                <form action="#" method="POST">
     
                   
      
                    <a class="btn btn-primary" href="{{url('update_catagory',$data->id)}}">Edit</a>
     
                    @csrf
                    
        
                    <a onclick="return confirm('Delete {{$data->title}} ?')"href="{{url('delete_catagory',$data->id)}}" class="btn btn-danger">Delete</a>
                </form>
            </td>
        </tr>
        @endforeach
        
    </table>
</div>



@include('admin.footer')

</body>
</html>

