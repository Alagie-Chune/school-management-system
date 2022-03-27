<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // View Users Method
    public function UserView() {
        $data['allData'] = User::where('usertype','Admin')->get();
        return view('backend.user.view_user', $data);
    }

    // Add Users Method
    public function UserAdd() {
        return view('backend.user.add_user');
    }

    // Store/Create User Method
    public function UserStore(Request $request) {

        // For Form Validation 
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required'
        ]);

        $data = new User();
        $code = rand(0000,9999);
        $data->usertype = 'Admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();

        $notification = array(
            'message' => 'User Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    } 

    // Edit Users Method
    public function UserEdit($id) {
        $editData = User::find($id);
        return view('backend.user.edit_user', compact('editData'));
    }

    // Update Users Method
    public function UserUpdate(Request $request, $id) {
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->role;
        $data->save();
        
        // Toastr Notification Message 
        $notification = array(
            'message' => 'User Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    // Delete Users Mwthod
    public function UserDelete($id) {
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => 'User Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }
}
