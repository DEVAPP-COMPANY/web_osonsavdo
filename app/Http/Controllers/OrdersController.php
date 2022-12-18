<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use App\Models\OrderProducts;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\OrderExport;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;


class OrdersController extends Controller
{
    public function orders(Request $request)
    {
        
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $status = $request->status;
        $date=$request->date;
        $fio=$request->fio;
        if($status == null){
            $status = 'waiting';
        }
        $start_date = date('Y-m-d').' 00:00:00';
        $end_date = date('Y-m-d').' 23:59:59';
        if($date != null){
            $start_date = substr($date, 0, 19);
            $end_date = substr($date, 22);
        }
        
        $orders=Orders::whereHas('app_user',  function ($query) use ($fio) {
            return $query->where('fullname', 'like', '%'.$fio.'%');
        })->where('status', $status)->whereBetween('created_at', [$start_date, $end_date]);
        
        $orders = $orders->get();
        return view('order.orders', compact('orders', 'status', 'start_date', 'end_date','fio'));
    }

    public function export(Request $request) 
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $status = $request->status;
        $date=$request->date;
        if($status == null){
            $status = 'waiting';
        }
        $start_date = date('Y-m-d').' 00:00:00';
        $end_date = date('Y-m-d').' 23:59:59';
        if($date != null){
            $start_date = substr($date, 0, 19);
            $end_date = substr($date, 22);
        }

        $orders=Orders::where('status', $status)->whereBetween('created_at', [$start_date, $end_date])->get();
        // foreach ($orders as $item) {
        //     $item->user = $items->app_user->fullname;
        // }
        return Excel::download(new OrderExport($orders), 'orders-'.$start_date.'-'.$end_date.'.xlsx');
    }

    public function orderShow($id)
    {
        $items=OrderProducts::where('order_id', $id)->get();
        $orders=Orders::find($id);
        return view('order.show', compact('orders','items'));
    }

    public function orderStatus(Request $request, $id)
    {
        if($request->session()->get('user') == null){
            return redirect('login');
        }
        $order=Orders::find($id);
        $order->status=$request->status;
        $order->update();
        return redirect('/orders');
    }
}
