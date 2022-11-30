<?php

namespace App\Http\Controllers;

use App\Book;
use App\Mail\DemoEmail;
use App\Order;
use App\OrderDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $itemPerPage = $_GET['itemPerPage'] ?? 5;
        $temp = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('books', 'books.id','=','order_details.book_id')
            ->select('users.user', 'orders.id', 'order_details.book_id', 'order_details.quantity',
                'books.name', 'books.hinhanh', 'books.giaban',
            DB::raw('order_details.quantity * books.giaban as price'))
            ->get();
        $num = count(Order::all());
        $orders = DB::table('orders')->paginate($itemPerPage);
        foreach ($orders as $order){
            $totalBook = 0;
            $totalPrice = 0;
            foreach ($temp as $item){
                if ($order->id == $item->id){
                    $totalPrice += $item->price;
                    $totalBook += $item->quantity;
                }
            }
            $order->user = User::find($order->user_id)->user;
            $order->totalBook = $totalBook;
            $order->totalPrice = $totalPrice;
        }

        return view(
            'admin.order.order',
            compact('orders', 'num', 'itemPerPage')
        )->with(
            'stt',
            (request()->input('page', 1) - 1) * $itemPerPage + 1
        );
    }

    public function view($id){
        $itemPerPage = $_GET['itemPerPage'] ?? 5;
        $list = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('books', 'books.id','=','order_details.book_id')
            ->where('orders.id', $id)
            ->select('orders.id', 'order_details.quantity', 'books.name', 'books.hinhanh', 'books.giaban',
                DB::raw('order_details.quantity * books.giaban as price'));
        $totalPrice = $list->get()->sum('price');
        $order = Order::find($id);
        $num = count($order->details);
        $list = $list->paginate($itemPerPage);
        return view(
            'admin.order.view',
            compact('list', 'num', 'itemPerPage', 'totalPrice')
        )->with(
            'stt',
            (request()->input('page', 1) - 1) * $itemPerPage + 1
        );
    }

    public function store(Request $request){
        $this->validate(request(), [
            'user' => 'required',
        ]);

        if($user = User::firstWhere('user', $request->user )){
            $order = new Order();
            $order->user_id = $user->id;
            $order->save();
            $notification = ['type' => 'success', 'message' => 'Thêm đơn hàng thành công'];
        }else{
            $notification = ['type' => 'error', 'message' => 'Thêm đơn hàng thất bại, không tìm thấy người dùng ' . $request->user . '!'];

        }

        return redirect()->route('admin.order')->with($notification['type'], $notification['message']);
    }

    public function approve($id){
        $order = Order::find($id);
//        dd($order->details);
//        $objDemo = new \stdClass();
//        $objDemo->action = 'duyệt';
//        $objDemo->created_at = $order->updated_at;
//        $objDemo->cart = $order->details;
//        $objDemo->receiver = Auth::user()->name;
//        Mail::to($order->user->email)->send(new DemoEmail($objDemo));

        $order->status = 'Đã duyệt';
        $order->save();
        Session::flash('success','Duyệt thành công!');

        return redirect()->route('admin.order');
    }

    public function delete($id){
        Order::find($id)->delete($id);
        $notification = ['type' => 'info', 'message' => 'Xóa đơn hàng thành công!'];
        return redirect()->route('admin.order')->with($notification['type'], $notification['message']);
    }
}
