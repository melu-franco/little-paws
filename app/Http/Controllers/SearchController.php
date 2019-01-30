<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public function index(Request $request){

        if($request->search == "") {
            $users = User::paginate(5);
            return view('dashboard.search-results', compact('users'));
        } else {
            $users = User::where('email', 'LIKE', '%'.$request->search.'%')
            ->orWhere('name','LIKE','%'.$request->search.'%')
            ->paginate(2);

            $users->appends($request->only('search'));
            return view('dashboard.search-results', compact('users'));
        }
    }

    public function search() {

    }
}
