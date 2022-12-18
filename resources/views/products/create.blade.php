@extends('header')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Yangi maxsulot kiritish</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form  action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Nomi</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nomi">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Narxi</label>
            <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Narxi">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Bo'lim</label>
          <select name="category_id" class="form-control">
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->title}}</option>  
            @endforeach
          </select>  
          </div>
          <div class="form-group">
          <label for="exampleInputFile">Rasm yuklash</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="image" id="exampleInputFile">
            </div>
            </div>
        </div>
     </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Qo'shish</button>
      </div>
    </form>
  </div>
   @endsection