@extends('header')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Bo'limni o'zgartirish</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form  action="{{url('categories/update', $categories->id)}}" method="POST" enctype="multipart/form-data">
       {{ csrf_field() }}
       {{ method_field('PUT') }}
      <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Nomi</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" value="{{$categories->title}}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Parent</label>
            <select name="parent_id" class="form-control" id="exampleInputEmail1">
              <option value="0">Parent</option> 
              @foreach ($parents as $parent)
                <option value="{{$parent->id}}">{{$parent->title}}</option> 
              @endforeach
            </select>
          </div>   
          <div class="form-group">
          <label for="exampleInputFile">Rasm yuklash</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="icon" id="exampleInputFile">
            </div>
            </div>
        </div>
     </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">O'zgartirish</button>
      </div>
    </form>
  </div>
   @endsection