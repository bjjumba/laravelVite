<?php

namespace App\Http\Controllers;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    public function index()

    {

        $user=User::get();
     
        return view('posts.index');
    }



   public function import_user(Request $request){

      $request->validate([
          'excel_file'=>'required|mimes:xlsx'
      ]);

      //use Excel
      Excel::import(new UsersImport, $request->file('excel_file'));

      return redirect()->back()->with('success', 'User Successfully imported');
   }
}
