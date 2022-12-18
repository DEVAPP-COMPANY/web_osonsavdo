@extends('header')
@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
               <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <strong>Kimdan</strong>
                  <address style="margin-top: 10px;">
                    {{$orders->app_user->fullname}}<br>
                    Tel: {{$orders->app_user->phone}}<br>
                   </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <strong> Qayerga</strong>
                  <address style="margin-top: 10px;">
                    {{$orders->adress}}<br>
                   Xarita:  <a href="https://yandex.ru/maps/?pt={{$orders->lon}},{{$orders->lat}}&z=18&l=map"><strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong></a>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                 <br>
                  Buyurtmachi ID: {{$orders->id}}<br>
                  Yetkazib berish turi: {{$orders->order_type}}<br>  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Soni</th>
                      <th>Product</th>
                      <th>Summa</th>
                      <th>Status</th>
                      <th>Qo'shilgan vaqt</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                    <tr>
                      <td>{{$item->count}}</td>
                      <td>{{$item->product->name}}</td>
                      <td>{{$item->summa}}</td>
                      <td>{{$item->status}}</td>
                      <td>{{$item->created_at}}</td>
                    </tr>
                    <tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                 <div class="col-md-6 col-md-offset-6">
                 <div class="table-responsive">
                    <table class="table">
                        <br>
                      <tr>
                        <th style="width:50%">Jami summa:</th>
                        <td>{{$orders->total_emount}} so'm</td>
                      </tr>
                      <tr>
                        <th>Status:</th>
                        <td>{{$orders->status}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                    
                  <form action="{{url('/order_status', $orders->id)}}" method="POST">
                    @csrf
                    <div class="form-group float-right">
                        <label for="exampleInputFile">Statusni o'zgartirish</label>
                    <select name="status"  style="margin: 5px">
                        <option value="waiting">Waiting</option>
                        <option value="confirm">Confirm</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancel">Cancel</option>
                    </select>
                    <input type="submit" class="btn btn-success" style="margin-right: 5px;" value="Saqlash">
                    </div>
                </form>
                  </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  
 
@endsection