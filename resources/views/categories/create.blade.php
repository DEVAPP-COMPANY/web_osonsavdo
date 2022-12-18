@extends('header')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Yangi bo'lim kiritish</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form  action="{{url('/categories/store')}}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Nomi</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Bo'lim nomi">
          </div>

            <div class="form-group">
            <label>Parent</label>
            <select name="parent_id" class="form-control">
              <option selected="selected" value="0">Parent</option>
              @foreach ($parents as $parent)
              <option value="{{$parent->id}}">{{$parent->title}}</option>
              @endforeach
            </select></div>
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
        <button type="submit" class="btn btn-primary">Qo'shish</button>
      </div>
    </form>
  </div>
   @endsection