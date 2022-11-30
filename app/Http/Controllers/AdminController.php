<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\OrderDetails;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function statistical(): array
    {
        $orderDetails = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('books', 'books.id','=','order_details.book_id')
            ->join('users', 'users.id', '=','orders.user_id');


        $lastMonth = Carbon::now()->subMonths(1);
        //region user
        $newUsers = DB::table('users')->where('created_at', '>', $lastMonth)->get();
        $allUser = count(User::all());
        $newUsersNum = count($newUsers);
        $oldUsers = ($allUser - $newUsersNum) == 0 ? 1 : ($allUser - $newUsersNum);
        $uGrowth = $newUsersNum / $oldUsers * 100;

        $vipUser = $orderDetails->select('users.id', 'users.user', DB::raw('SUM(order_details.quantity * books.giaban) as price'))
            ->groupBy('users.id', 'users.user')
            ->orderBy('price', 'desc')
            ->get()->toArray();
        $forUsers = ['uAll' => $allUser, 'uNew' => $newUsersNum, 'uGrowth' => $uGrowth];
        //endregion
        //region book

        $allBooks = count(Book::all());
        $soldCount = OrderDetails::all()->sum('quantity');
        $top5Book = DB::table('order_details')
            ->select('order_details.book_id', 'books.name', 'books.giaban', DB::raw('SUM(quantity) as sldaban'))
            ->join('books', 'books.id', '=', 'order_details.book_id')
            ->groupBy('order_details.book_id', 'books.name', 'books.giaban')
            ->orderBy('sldaban','desc')
            ->take(5)
            ->get();

        $totalBook = Book::all()->sum('soluong');
        $forBook = ['bAll' => $allBooks, 'bSold' => $soldCount, 'bTop' => $top5Book, 'bTotal' => $totalBook];
        //endregion
        //region category
        $allCategory = count(Category::all());
        $forCategory = ['cAll' => $allCategory];
        //endregion
        //region doanhthu
        $orderTotal = $orderDetails->select('orders.id', DB::raw('SUM(order_details.quantity * books.giaban) as price'))
            ->groupBy('orders.id')
            ->get();
        $orderLastMonth = $orderDetails->where('orders.created_at', '>', $lastMonth)
            ->select('orders.id', DB::raw('SUM(order_details.quantity * books.giaban) as price'))
            ->groupBy('orders.id')
            ->get();
        $doanhThuTong = 0;
        $doanhThuThang = 0;
        foreach ($orderTotal as $item){
            $doanhThuTong += $item->price;
        }
        foreach ($orderLastMonth as $item){
            $doanhThuThang += $item->price;
        }
        $doanhThu = ['tong' => $doanhThuTong, 'thang' => $doanhThuThang];
        //endregion

        return ['fUser' => $forUsers, 'fBook' => $forBook, 'fCategory' => $forCategory, 'doanhthu' => $doanhThu, 'vipUser' => $vipUser];
    }

    public function index()
    {
        $data = $this->statistical();
        return view('admin.dashboard', compact('data'));
    }

    public function updateinfo()
    {
        $user = User::find(Auth::user()->getAuthIdentifier());
        return view('admin.info.updateinfo', compact('user'));
    }

    function dashboard()
    {
        return redirect(route('admin.index'));
    }
}
