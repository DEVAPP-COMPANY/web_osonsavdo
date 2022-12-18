@extends('header')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">App foyydalanuvchilar</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
           <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Ismi</th>
                <th>Tel</th>
                <th>Confirm</th>
                <th>Kiritilgan vaqt</th>
                
              </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->is_confirm == 1 ? 'true': 'false'}}</td>
                    <td>{{$user->created_at}}</td>
               </tr> 
                @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
    @endsection