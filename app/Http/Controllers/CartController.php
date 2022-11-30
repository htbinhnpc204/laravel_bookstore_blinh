<?php

namespace App\Http\Controllers;

use App\Book;
use App\Mail\DemoEmail;
use App\Order;
use App\OrderDetails;
use Illuminate\Support\Facades\App;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal;

class CartController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateCart(Request $request)
    {
        $id = $request->id;
        $book = Book::find($id);
        $cart = Session::get('cart');
        $type = $request->type;

        if($type == '-'){
            $cart[$id]['qty'] -= 1;
        }else{
            $cart[$id]['qty'] += 1;
        }

        $total = $book->giaban * $cart[$id]['qty'];

        Session::put('cart', $cart);
        Session::put('total', $total);
        return json_encode($cart[$id]);
    }

    public function addToCart(Request $request, $id)
    {
        $book = DB::select('select * from books where id='.$id);
        $cart = Session::get('cart');
        if(isset($cart[$id])){
            $cart[$id]['qty'] += $request->get('quantity');
        }
        else{
            $cart[$book[0]->id] = array(
                "book_id" => $book[0]->id,
                "qty" => $request->get('quantity'),
                "giaban" => $book[0]->giaban
            );
        }
        $total = Session::get('total');
        $total += $book[0]->giaban * $request->get('quantity');
        Session::put('cart', $cart);
        Session::put('total', $total);
        Session::flash('success','Thêm vào giỏ hàng thành công!');
        return redirect()->back();
    }

    public function deleteItem($id)
    {
        $cart = Session::get('cart');

        $book = DB::select('select * from books where id='.$id);
        if(count($cart) === 0){
            Session::remove('cart');
            Session::remove('total');
            return redirect()->back();
        }

        $total = Session::get('total');
        $total -= $book[0]->giaban * $cart[$id]['qty'];

        unset($cart[$id]);

        Session::put('cart', $cart);
        Session::put('total', $total);
        Session::flash('success','Xóa sản phẩn thành công!');

        return redirect()->back();
    }

    public function view(){
        return view('cart');
    }

    public function create_order(){
        $cart = Session::get('cart');
        if(empty($cart)){
            Session::flash('success','Giỏ hàng rỗng!');
            return redirect()->route('index');
        }
        if(\auth()->user()->profile->diachi == null || \auth()->user()->profile->sdt == null){
            Session::flash('error', 'Vui lập cập nhật địa chỉ và sđt liên hệ.');
            return redirect()->route('profile');
        }
        $order = Order::create([
            'user_id' => Auth::user()->id
        ]);
        foreach ($cart as $key => $value){
            OrderDetails::create([
                'order_id'  => $order->id,
                'book_id'   => $key,
                'quantity'  => $value['qty']
            ]);
            $book = Book::find($key);
            $book->soluong = $book->soluong - $value['qty'];
            $book->save();
        }

//        $objDemo = new \stdClass();
//        $objDemo->action = 'tạo';
//        $objDemo->created_at = $order->created_at;
//        $objDemo->cart = $cart;
//        $objDemo->receiver = Auth::user()->name;
//        Mail::to(Auth::user()->email)->send(new DemoEmail($objDemo));

        Session::put('cart_old', \session()->get('cart'));
        Session::put('order_id', $order->id);

        Session::forget('cart');
        Session::forget('total');
        Session::flash('success','Tạo đơn hàng thành công!');
        return redirect()->route('checkout');
    }


    public function printBill($id){
        $order = Order::find($id);
        $details = $order->details;
        $data = [
            'title' => 'Hóa đơn mua hàng',
            'details' => $details,
            'order' => $order,
            'buyer' => $order->user->name == '' ? $order->user->user : $order->user->name,
        ];
        $pdf = PDF::loadView('bill',$data);
        return $pdf->download('donhang_'.$order->id.'.pdf');
    }
}
