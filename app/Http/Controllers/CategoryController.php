<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $itemPerPage = $_GET['itemPerPage'] ?? 5;
        $paginator = DB::table('categories')->paginate($itemPerPage);
        $num = count(Category::all());
        return view('admin.category.category', compact('paginator', 'num', 'itemPerPage'))->with('stt', (request()->input('page', 1) - 1) * $itemPerPage + 1);
    }

    public function delete($id)
    {
        category::find($id)->delete($id);
        $notification = [
            'message' => 'Xóa chủ đề thành công.!',
            'alert-type' => 'info'
        ];
        return redirect('./admin/category')->with('info', $notification['message']);
    }

    public function add(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);

        $category = new Category();
        $category->category_name = $request->input('name');
        $category->push();

        $notification ='Thêm chủ đề thành công.!';
        return redirect('./admin/category')->with('success', $notification);
    }

    public function edit(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->category_name = $request->input('name');
        $category->push();

        $notification = [
            'message' => 'Sửa chủ đề thành công.!',
            'alert-type' => 'info'
        ];
        return redirect('./admin/category')->with('notification', $notification);
    }
}
