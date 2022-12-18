<?php

namespace App\Http\Controllers;
use App\Models\Offers;
use App\Models\Categories;
use App\Models\Products;
use App\Models\AppUser;
use App\Models\Orders;
use App\Models\OrderProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
     /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $success, $message, $error_code = 0)
    {
    	$response = [
            'success' => $success,
            'data'    => $result,
            'message' => $message,
            'error_code' => $error_code,
           
         ];


        return response()->json($response, 200);
    }

    public function checkToken(Request $request){
        $token=$request->header('X-API-TOKEN');
        if ($token != null && $token != ""){
            $user=AppUser::where('token',  $token)->first();
            return $user;
        }else{
            return null;
        }
    }

    public function offers()
    {
            return $this->sendResponse(Offers::get(), true, "");
    }

    public function categories()
        {
            return $this->sendResponse(Categories::get(), true, "");
        }
    
        public function topproducts()
        {
            return $this->sendResponse(Products::get(), true, "");
        }

        public function products(Request $request, $cat_id)
        {
            $products=Products::where('category_id',  $cat_id)->get();
            
            return $this->sendResponse($products, true, "");
        }

        public function productsByIds(Request $request)
        {
            $products=Products::whereIn('id', $request->products)->get();
            
            return $this->sendResponse($products, true, "");
        }

        public function product($id)
        {
            $item = Products::find($id);
            if($item != null){
                return $this->sendResponse($item, true, "");
            }else{
                return $this->sendResponse(null, false, "Mahsulot topilmadi");
            }
        }
        public function checkPhone(Request $request)
        {
            $user=AppUser::where('phone', $request->phone)->first();
            if(!$user){
                return $this->sendResponse(["is_reg"=>false], true, "Telefon nomer topilmadi");
            }
            else{
                return $this->sendResponse(["is_reg"=>true], true, "");
               
            }
        }
            public function login(Request $request)
            {
                 $user=AppUser::where('phone', $request->phone)->first();
                 if(!$user || !Hash::check($request->password, $user->password))
                 {
                    return $this->sendResponse(null, false, "Telefon raqami yoki parol xato!");
                 }
               else{
                    $user->token=Str::random(32);
                    $user->update();
                    $token=$user->token;
                    return $this->sendResponse(['token'=>$token], true, "");
               }
            }
        
            public function register(Request $request)
            {
               $user=AppUser::where('phone', $request->phone)->first();
               if($user != null){
                   return $this->sendResponse(null, false, "Siz registratsiyadan o'tgansiz");
               }else{
                $user=New AppUser();
                $user->fullname=$request->fullname;
                $user->phone=$request->phone;
                $user->password=Hash::make($request->password);
                $user->sms_code=1111;
                $user->token=Str::random(32);
                $user->save();
                return $this->sendResponse(null, true, "Registratsiyadan o'tdingiz");

               }
            }
            public function confirm(Request $request)
            {
                $confirm=AppUser::where('phone', $request->phone)
                ->where('sms_code', $request->sms_code)->first();
                if($confirm){
                    $confirm->is_confirm=1;
                    $confirm->token=Str::random(32);
                    $confirm->update();
                    $token=$confirm->token;
                    return $this->sendResponse(['token'=>$token], true, "");
                }
                else{
                    return $this->sendResponse(null, false, "Telefon raqami yoki sms kod xato!");
                }
               
            } 

            public function makeOrder(Request $request)
            {
                $app_user_id = $this->checkToken($request);
                if($app_user_id == null){
                    return $this->sendResponse(null, false, "Token hato", 1);
                }
                $app_user_id = $this->checkToken($request);
                $order= New Orders;
                $order->app_user_id=$app_user_id->id;
                $order->order_type=$request->order_type;
                $order->adress=$request->adress;
                $order->total_emount=0;
                $order->lat=$request->lat;
                $order->lon=$request->lon;
                $order->comment=$request->comment;
                $order->status="waiting";
                $order->save();
                $products=$request->products;
                foreach ($products as $product){
                    $id=$product["id"];
                    $item=Products::find($id);
                    $price=$item->price;
                    $order_product=New OrderProducts;
                    $order_product->order_id=$order->id;
                    $order_product->product_id=$id;
                    $order_product->count=$product["count"];
                    $order_product->summa=$price*$product["count"];
                    $order_product->status="waiting";
                    $order_product->save();
                    }
                    $order_id=$order->id;
                    $total_emount=OrderProducts::where('order_id', $order_id)->sum("summa");
                    $order->update(["total_emount"=>$total_emount]);
                return $this->sendResponse(["order_id"=>$order_id], true, "Order saqlandi");
            }

            public function orders(Request $request)
            {
                $app_user_id = $this->checkToken($request);
                if($app_user_id == null){
                    return $this->sendResponse(null, false, "Token hato", 1);
                }else{
                    $orders=Orders::where('app_user_id', $app_user_id->id)->get();
                    return  $this->sendResponse(['orders'=>$orders], true, "");
                }
               
            }

            public function order(Request $request, $id)
            {
                $order =Orders::find($id);
                if($order == null){
                    return $this->sendResponse(null, false, "Order topilmadi");
                }else{
                   $products=OrderProducts::where('order_id', $id)->get();
                   foreach($products as $product)
                   {
                    $product->product_id=$product->product->name;
                   }                   
                    return  $this->sendResponse(['orders'=>$order, 'products'=>$products], true, "");
                }
               
            }
    }
