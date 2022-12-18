
@extends('header')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Buyurtmalar</h3>
            <div class="card-tools">     
            <form  action="{{url('/orders')}}" method="GET">
              <div class="row">
                <div class="form-group">
                  <label for="exampleInputFile">FIO</label>
                       <input type="text" name="fio" class="form-control" value="{{$fio ? $fio: ''}}" placeholder="fioni kiriting">
                </div>
                <div class="form-group" style="margin:5px;">
                  <label for="exampleInputFile">Vaqt</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" value="{{$start_date.' - '.$end_date}}" name="date" id="reservationtime">
                  </div>
                </div>
             <div class="form-group">
              <label for="exampleInputFile">Status</label>
                    <select name="status" class="form-control">
                        <option value="waiting" {{ $status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="confirm" {{ $status == 'confirm' ? 'selected' : '' }}>Confirm</option>
                        <option value="processing" {{ $status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancel" {{ $status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                    </select>
            </div>
            <div class="form-group" style="margin-left:5px;">
              <label for="exampleInputFile">Filtr</label>
           <input type="submit" class="form-control btn btn-success" value="Filtrlash">
          </div>
          </form>       
           </div>
        </div>
        <!-- /.card-header -->
            {{-- <div class="btn-group">
              <a href="{{url('/orders?status=waiting')}}" class="fc-dayGridMonth-button btn btn-warning {{ $status == 'waiting' ? 'active' : '' }}">Waiting</a>
              <a href="{{url('/orders?status=confirm')}}" class="fc-dayGridMonth-button btn btn-primary {{ $status == 'confirm' ? 'active' : '' }}">Confirm</a>
              <a href="{{url('/orders?status=processing')}}" class="fc-dayGridMonth-button btn btn-primary  {{ $status == 'processing' ? 'active' : '' }}">Processing</a>
              <a href="{{url('/orders?status=completed')}}" class="fc-dayGridMonth-button btn btn-success {{ $status == 'completed' ? 'active' : '' }}">Completed</a>
              <a href="{{url('/orders?status=cancel')}}" class="fc-dayGridMonth-button btn btn-danger {{ $status == 'cancel' ? 'active' : '' }}">Cancel</a>
           </div> --}}
      
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Buyurtmachi</th>
                <th>Buyurtma turi</th>
                <th>Umumiy narx</th>
                <th>Status</th>
                <th>Qo'shilgan vaqt</th>
                <th>Xarita</th>
                <th>Ko'rish</th>
              </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->app_user->fullname}}</td>
                    <td>{{$order->order_type}}</td>
                    <td>{{$order->total_emount}}</td>
                    <td> <span class="badge badge-primary">{{$order->status}}</span></td>
                    <td>{{$order->created_at}}</td>
                    <td><a href="https://yandex.ru/maps/?pt={{$order->lon}},{{$order->lat}}=18&l=map"><button class="btn btn-danger"><i class="fas fa-map-marker-alt mr-1"></i> Location</strong></button></a></td>
                    <td><a href="{{url('order_show', $order->id)}}"><button class="btn btn-info">Ko'rish</button></a></td>
                </tr> 
                @endforeach
            </tbody>
          </table>
          <a href="{{url('orders/export?status='.$status.'&date='.$start_date.' - '.$end_date)}}" class="fc-dayGridMonth-button btn btn-primary">EXCEL</a>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
    @endsection