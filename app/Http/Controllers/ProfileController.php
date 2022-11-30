<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function doUpdate(Request $request, $id){
        $this->validate(request(),[
            'user_name' => 'required',
            'sdt' => 'required',
            'diachi' => 'required'
        ]);
        $profile = Profile::where('user_id', $id)->first() ?? new Profile();
        $user = User::find( $id );
        $profile->sdt = $request->input( 'sdt' );
        $profile->user_id = $user->id;
        $profile->diachi = $request->input( 'diachi' );
        $profile->push();
        $user->name = $request->input( 'user_name' );
        $user->push();
        Session::flash('success', 'Cập nhật thông tin thành công ♥☺');
        return redirect('admin/dashboard');
    }
}
