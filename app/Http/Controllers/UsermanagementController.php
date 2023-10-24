<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class UsermanagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
        	
    public function UserList(Request $request)
    {
        $list = DB::table('users')->get();
        return view('user.list_user',compact('list'));
    }


public function UserAdd()
{
$all = DB::table('users')->get();
return view('user.create_User',compact('all'));
}

    

//     public function UserInsert(Request $request)
//     {
// $data = array();
// $data['role'] = $request->role;

// $insert = DB::table('users')->insert($data);
       
// if ($insert) 
// {
   
//                 return Redirect()->route('user.index')->with('success','User created successfully!');
                 
//         }
// else
//         {
//         $notification=array
//         (
//         'messege'=>'error ',
//         'alert-type'=>'error'
//         );
//         return Redirect()->route('User.index')->with($notification);
//         }
           
// }

      public function UserEdit ($id)
    {
        $edit=DB::table('users')
             ->where('id',$id)
             ->first();
        return view('user.edit_user', compact('edit'));     
    }

        public function UserUpdate(Request $request,$id)
    {
      
        DB::table('users')->where('id', $id)->first();        
        $data = array();
        $data['role'] = $request->role;
        $update = DB::table('users')->where('id', $id)->update($data);

        if ($update) 
    {
            
            return Redirect()->route('user.index')->with('success','User Berhasil Diupdate!');                     
    }
        else
    {
        
        return Redirect()->route('user.index')->with('error','Oops, ada sesuatu yang Salah!');    
    }
     
    }

public function UserDelete ($id)
    {
    
        $delete = DB::table('users')->where('id', $id)->delete();
        if ($delete)
                            {
                                return Redirect()->route('user.index')->with('success','User Berhasil Dihapus!');                  
                            }
             else
                  {
                    return Redirect()->route('user.index')->with('error','Oops, ada sesuatu yang Salah!');  
                  }

      }
public function changeRole($id)
{
    $user = DB::table('users')->where('id', $id)->first();

    if ($user->role == 3) {
        DB::table('users')->where('id', $id)->update(['role' => 2]);
        return redirect()->route('user.index')->with('success', 'Izin akun berhasil diubah.');
    } else {
        return redirect()->route('user.index')->with('error', 'Tidak dapat mengubah izin akun.');
    }
}

}
