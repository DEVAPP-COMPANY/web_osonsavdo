@extends('header')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Bo'limlar</h3>
           </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <a href="{{url('categories/create')}}"><button class="btn btn-success" style="margin: 20px; float:right; width:200px;">Yangi qo'shish</button></a>
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nomi</th>
                <th>Parent</th>
                <th>Icon</th>
                <th>O'zgartirish</th>
                <th>O'chirish</th>
              </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->title}}</td>
                    <td>{{$category->parent_id}}</td>
                    <td><img src="{{asset('images/')}}/{{$category->icon}}" style="width: 50px;"></td>
                    <td><a href="{{url('/categories/edit', $category->id)}}"><button class="btn btn-primary">O'zgartirish</button></a></td>
                    <td><form action="{{url('categories/destroy', $category->id)}}" method="post" enctype="multipart/form-data" onsubmit="if(confirm('Ma\'lumotni o\'chirishni xohlaysizmi?'))  { return true } else {return false }">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}              
                       <input type="submit" value="O'chirish" class="btn btn-danger">                      
                      </form></td>
                  </tr> 
                @endforeach
            </tbody>
          </table>
         
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
  @endsection