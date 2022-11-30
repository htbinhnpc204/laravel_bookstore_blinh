<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\OrderDetails;
use App\Profile;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $xmlBookPath = 'xml/book.xml';
        $models = Book::all();
        $xml = response()->xml(['book'=>$models->toArray()]);
        Storage::put($xmlBookPath, $xml->getContent());
    }

    public function index()
    {
        $categories = Category::all()->sortBy('category_name');
        $books = Book::all()->sortBy('name');
        return view('home', compact('categories', 'books'));
    }

    public function category($cd_id)
    {
        $categories = Category::all()->sortBy('name');
        $books = Category::find($cd_id)->book;
        return view('category', compact('categories', 'books', 'cd_id'));
    }

    public function buy($book_id)
    {
        $book = Book::find($book_id);
        $sold = DB::table('order_details')->where('book_id',$book_id)->sum('quantity');
        $details = OrderDetails::with('reviews')->where('book_id', $book_id)->where('rStatus', 1)->get();
        $rating = 0;
        foreach ($details as $detail){
            $rating += $detail->reviews->rating;
        }
        if($rating != 0) $rating /= count($details);
        $related_books = Book::where('category_id', $book->category_id)->take(8)->get();
        return view('buy', compact('details','book', 'sold', 'related_books','rating'));
    }

    public function updateinfo() {
        $user = Auth::user();
        return view( 'updateinfo', compact( 'user' ) );
    }

    public function profile(){
        $histories = Auth::user()->order;
        return view('profile', compact('histories'));
    }

    public function doUpdateuser(Request $request, $id ) {
        $this->validate( request(), [
            'name' => 'required',
            'sdt' => 'required',
            'diachi' => 'required',
            'email'=> 'required'
        ] );
        $profile = Profile::where('user_id', $id)->first() ?? new Profile();
        $user = User::find( $id );
        $profile->sdt = $request->input( 'sdt' );
        $profile->user_id = $user->id;
        $profile->diachi = $request->input( 'diachi' );
        $profile->push();
        $user->name = $request->input( 'name' );
        $user->email = $request->input( 'email' );
        $user->push();

        Session::flash( 'success','Cập nhật thông tin cá nhân thành công ♥');
        return redirect( )->route('index');
    }

    public function all_product(){
        $categories = Category::all();
        $category_id = \session()->get('filter-categories') ?? Category::all()->pluck('id')->toArray();

        $books = DB::table('books')->whereIn('category_id', $category_id);

        if(\session()->get('filter-ranges')){
            $books = $books->whereBetween('giaban', \session()->get('filter-ranges'));
        }

        $books = $books->orderBy('giaban');
        $books = $books->paginate(9);

        return view('product', compact('books', 'categories', 'category_id'));
    }

    public function filter(Request $request){
        $request->categories != null ? Session::put('filter-categories', $request->categories)
            : Session::flush('filter-categories');
        $request->range != null ? Session::put('filter-ranges', $request->range)
            : Session::flush('filter-ranges');
    }

    public function review(Request $request)
    {
        $variable = $request->validate([
           'rating' => 'required|min:0|max:5',
           'comment'=> 'required'
        ]);
        $review = new Review();
        $review->order_details_id = $request->detail;
        $review->rating = $variable['rating'];
        $review->comment = $variable['comment'];
        $review->save();

        $detail = OrderDetails::find($request->detail);
        $detail->rStatus = true;
        $detail->save();

        Session::flash('success', 'Bạn đã thêm đánh giá thành công');
        return back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

}
