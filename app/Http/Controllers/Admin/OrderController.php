<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id=Session()->get('admin_id');
        if($admin_id)
        return redirect::to('/dashboard');
        else
        return redirect::to('/admin')->send();

    }
    public function manager_order(){
        $this->AuthLogin();
        $order=Order::orderby('created_at','desc')->get();
        return view('admin.manager_order')->with(compact('order'));
    }  
    public function view_order($order_code){
        $order_details=OrderDetail::where('order_code',$order_code)->get();
        $order=Order::where('order_code',$order_code)->get();
        foreach($order as $key => $ord){
           $customer_id = $ord->customer_id;
           $shipping_id = $ord->shipping_id;        
        } 
        $customer= Customer::where('customer_id',$customer_id)->first();
        $shipping=Shipping::where('shipping_id',$shipping_id)->first();
        $order_detailss=OrderDetail::with('product')->where('order_code',$order_code)->get();
        
        return view('admin.view_order')->with(compact('order_details','customer','shipping','order_detailss','order'));
    }
    public function delete_order($order_id){
        $this->AuthLogin();
        DB::table('tbl_order')->where('order_id',$order_id)->delete();
        session()->put('message',' Xóa thành công');
        return Redirect::to('manager-order');
    }
    public function update_order(Request $request){
        $data=$request->all();
        $order=Order::find($data['order_id']);
        $order->order_status=$data['order_status'];
        $order->save();
        if($order->order_status==2){
            foreach($data['order_product_id'] as $key1 =>$product_id){
                $product=Product::find($product_id);   
                $product_qty=$product->product_quantity;               
                foreach($data['quantity'] as $key2 =>$qty){
                    if($key1==$key2){
                        $product_result=$product_qty-$qty;
                        $product->product_quantity=$product_result;
                        $product->save();
                    }
                }
            }
        }
        elseif($order->order_status!=2&&$order->order_status!=3){
            foreach($data['order_product_id'] as $key1 =>$product_id){
                $product=Product::find($product_id);   
                $product_qty=$product->product_quantity;               
                foreach($data['quantity'] as $key2 =>$qty){
                    if($key1==$key2){
                        $product_result=$product_qty+$qty;
                        $product->product_quantity=$product_result;
                        $product->save();
                    }
                }
            }
        }
    }
    public function update_qty(Request $request){
        $data=$request->all();
        $order_details=OrderDetail::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_qty=$data['order_qty'];
        $order_details->save();
    }
}
