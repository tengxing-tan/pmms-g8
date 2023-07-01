<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() //display all user
    {

        $users = User::get();

        return view('UserRegistrationView.UserListingPage', ["users" => $users]);
    }

    public function create()    //create new user
    {

        $roles = Role::get();

        return view('UserRegistrationView.RegistrationForm', ["roles" => $roles]);
    }

    public function store(Request $request) //save new user
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect(url('user-listing'))->with('success','User Added Successfully');

    }

    public function edit($id)   //get user info to be edited
    {
        $users = User::find($id);
        $roles = Role::get();
        $userRole = $users->roles->pluck('id')->toArray();

        return view('UserRegistrationView.EditUserForm',["users" => $users,"roles" => $roles,"userRole" => $userRole]);

    }

    public function update(Request $request, $id)   //update user info
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ]);

        $input = $request->all();

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect(url('user-listing'))->with('success','User Updated Successfully');

    }

    public function destroy($id)    //delete user
    {
        User::where('id','=',$id)->delete();

        return redirect()->back()->with('success','User Deleted Successfully');
    }


}
