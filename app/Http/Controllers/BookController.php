<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


class BookController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $itemPerPage = $_GET['itemPerPage'] ?? 5;
        $categories = Category::all()->sortBy('name');
        $books = DB::table('books')->paginate($itemPerPage);
        $totals = Book::all();
        $num = count($totals);
        $total = 0;
        foreach ($totals as $book) {
            $total += $book->soluong;
        }
        return view('admin.book.book', compact('books', 'num', 'total', 'categories', 'itemPerPage'))->with('stt', (request()->input('page', 1) - 1) * $itemPerPage + 1);
    }

    public function delete($id)
    {
        Book::find($id)->delete($id);
        $notification = 'Xóa sách thành công.!';
        return redirect('./admin/book')->with('info', $notification);
    }

    public function edit($id)
    {
        $categories = Category::all()->sortBy('name');
        $model = Book::find($id);
        return view('admin.book.edit', compact('model', 'categories'));
    }

    public function store(Request $request)
    {
        $book_id = $request->book_id;

        $this->validate(request(), [
            'name' => 'required',
            'giaban' => 'required|min:0',
            'soluong' => 'required|numeric|min:0',
            'category_id' => 'required',
            'tacgia' => 'required',
            'nxb' => 'required',
        ]);

        $imageName = '';
        if ($request->has('hinhanh')) {
            $imageName = time() . '.' . $request->hinhanh->extension();
            $image_resize = Image::make($request->file('hinhanh')->getRealPath());
            $image_resize->fit(262, 360);
            $image_resize->save(public_path('images/' . $imageName));
            if (!empty($book_id)) {
                File::delete('public/images/' . Book::find($book_id)->hinhanh ?? '');
            }
        } else {
            if (!empty($book_id)) {
                $imageName = Book::find($book_id)->hinhanh;
            }
        }

        $book = Book::find($book_id);

        if (empty($book)) {
            $book = new Book();
        }
        $book->name = $request->name;
        $book->giaban = $request->giaban;
        $book->soluong = $request->soluong;
        $book->category_id = $request->category_id;
        $book->tacgia = $request->tacgia;
        $book->nxb = $request->nxb;
        $book->hinhanh = $imageName;
        $book->gioithieu = $request->description;
        $book->taiban = $request->taiban;

        $book->push();

        if (empty($request->book_id)) {
            $msg = 'Thêm sách thành công.';
        } else {
            $msg = 'Cập nhật thông tin sách thành công.';
        }

        return redirect()->route('admin.book')->with('success', $msg);
    }


    public function insertList(Request $request)
    {
        if (!$request->has('xmlFile')) {
            Session::flash('error', 'Bạn cần chọn file');
            return redirect()->back();
        }
        if ($request->xmlFile->clientExtension() != 'xml') {
            Session::flash('error', 'Vui lòng chọn file xml');
            return redirect()->back();
        }
        $xml = simplexml_load_string($request->xmlFile->get());
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        if (!empty($array['book'])) {
            foreach ($array['book'] as $item) {
                if (!( empty($item['name']) || empty($item['giaban']) || empty($item['soluong']) || empty($item['category_id'])
                    || empty($item['tacgia']) || empty($item['nxb']) || empty($item['gioithieu']) || empty($item['taiban'])))
                {
                    $book = new Book();
                    $book->name = $item['name'];
                    $book->giaban = $item['giaban'];
                    $book->soluong = $item['soluong'];
                    $book->category_id = $item['category_id'];
                    $book->tacgia = $item['tacgia'];
                    $book->nxb = $item['nxb'];
                    $book->gioithieu = $item['gioithieu'];
                    $book->taiban = $item['taiban'];
                    $book->push();
                }
            }
        } else {
            Session::flash('success', 'File không đúng định dạng');
            return redirect()->back();
        }
        Session::flash('success', 'Thêm thành công ' . count($array['book']) . ' sách!');
        return redirect()->back();
    }

    public function export(){

        $xmlBookPath = 'download/xml/book.xml';
        $models = Book::all();
        $xml = response()->xml(['book'=>$models->toArray()]);
        Storage::put($xmlBookPath, $xml->getContent());

        $headers = array(
            'Content-Type: application/xml',
        );

        $path = storage_path().'/'.'app' . '/' . $xmlBookPath;

        return response()->download($path, 'book.xml', $headers);
    }
}
