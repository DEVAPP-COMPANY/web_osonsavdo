@extends('header')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Yangi e'lon kiritish</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form  action="{{route('offers.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="card-body">
         <div class="form-group">
          <label for="exampleInputFile">Rasm yuklash</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="offer_img" id="exampleInputFile">
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