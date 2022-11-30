<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LiveSearchController extends Controller
{
    //
    public function doSearch(Request $request){
        $key = $request->get('key');
        $result = DB::table('books')->where('name', 'like', '%' . $key . '%' )
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
        return json_encode($result);
    }
}
