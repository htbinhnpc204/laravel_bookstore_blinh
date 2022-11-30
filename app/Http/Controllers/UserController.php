<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $itemPerPage = $_GET['itemPerPage'] ?? 5;
        $roles = Role::all()->sortBy('roleName');
        $users = DB::table('users')->paginate($itemPerPage);
        $totals = User::all();
        $num = count($totals);
        return view('admin.user.user', compact('users', 'num', 'roles', 'itemPerPage'))->with('stt', (request()->input('page', 1) - 1) * $itemPerPage + 1);
    }

    public function edit($id){
        $roles = Role::all()->sortBy('name');
        $model = User::find($id);
        return view('admin.user.edit', compact('model', 'roles'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'user' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => 'required',
        ]);

        $user = new User();

        $user->user = $request->user;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        $user->push();
            $msg = 'Thêm người dùng thành công.';
            $msg = 'Cập nhật thông tin người dùng thành công.';

        return redirect()->route('admin.user')->with('success', $msg);
    }

    public function update(Request $request)
    {
        $this->validate(request(), [
            'user' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:5'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role_id' => 'required',
        ]);

        $user = User::find($request->id);

        $user->user = $request->user;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        $user->push();

        $msg = 'Cập nhật thông tin người dùng thành công.';

        return redirect()->route('admin.user')->with('success', $msg);
    }

    public function delete($id)
    {
        User::find($id)->delete($id);
        $notification = 'Xóa người dùng thành công thành công.!';
        return redirect('./admin/user')->with('info', $notification);
    }
}
