@extends('header')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Maxsulotlar</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <a href="{{route('products.create')}}"><button class="btn btn-success" style="margin: 20px; float:right; width:200px;">Yangi qo'shish</button></a>
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Rasmi</th>
                <th>Nomi</th>
                <th>Narxi</th>
                <th>Kategoriya</th>
                <th>Kiritilgan vaqt</th>
                <th>Ko'rish</th>
                <th>O'zgartirish</th>
                <th>O'chirish</th>
              </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td><img src="images/{{$product->image}}" style="width: 50px;"></td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}} so'm</td>
                    <td>{{$product->category->title}}</td>
                    <td>{{$product->created_at}}</td>
                    <td><a href="{{route('products.show', $product->id)}}"><button class="btn btn-info">Ko'rish</button></a></td>
                    <td><a href="{{route('products.edit', $product->id)}}"><button class="btn btn-primary">O'zgartirish</button></a></td>
                    <td><form action="{{route('products.destroy', $product->id)}}" method="post" enctype="multipart/form-data" onsubmit="if(confirm('Ma\'lumotni o\'chirishni xohlaysizmi?'))  { return true } else {return false }">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}              
                       <input type="submit" value="O'chirish" class="btn btn-danger">                      
                      </form></td>
                  </tr> 
                @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            {!! $products->links() !!}
        </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
    @endsection