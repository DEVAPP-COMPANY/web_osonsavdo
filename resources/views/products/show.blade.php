@extends('header')
@section('content')
<div class="container">
    <div class="row" >
    <div class="col-sm-6">
    <img src="../images/{{$item->image}}" style="height:200px; margin-top: 10px;">
    </div>
        <div class="col-sm-6" style="height:200px; margin-top: 10px; line-height: 10px;">
        <h3>{{$item->name}}</h3>
        <h4>Narx: {{$item->price}} so'm</h4>
        <h5>Kategoriya: {{$item->category->title}}</h5>
        <h5>Qo'shilgan vaqti: {{$item->created_at}}</h5>
        <br><br>
        {{-- <a href="{{route('products')}}"><button class="btn btn-info">Qaytish</button></a> --}}
        <br><br>
        </div>
    </div>
    @endsection