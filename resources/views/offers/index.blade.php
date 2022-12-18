@extends('header')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">E'lonlar</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <a href="{{route('offers.create')}}"><button class="btn btn-success" style="margin: 20px; float:right; width:200px;">Yangi qo'shish</button></a>
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>Id</th>
                <th>Rasmi</th>
                <th>O'chirish</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)             
              <tr>
                <td>{{$offer->id}}</td>
                <td><img src="images/{{$offer->image}}" style="width: 100px"></td>   
                <td><form action="{{route('offers.destroy', $offer->id)}}" method="post" enctype="multipart/form-data" onsubmit="if(confirm('Ma\'lumotni o\'chirishni xohlaysizmi?'))  { return true } else {return false }">
                     {{ csrf_field() }}
                     {{ method_field('DELETE') }}              
                    <input type="submit" value="O'chirish" class="btn btn-danger">
                   
                   </form></td>
              </tr> 
              @endforeach             
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            {!! $offers->links() !!}
        </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
   @endsection