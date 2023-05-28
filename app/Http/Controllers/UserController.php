<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index()
    {

        $users = User::get();

        return view('UserRegistrationView.UserListingPage', ["users" => $users]);
    }

    public function create()
    {

        $roles = Role::get();

        return view('UserRegistrationView.RegistrationForm', ["roles" => $roles]);
    }

    public function store(Request $request)
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

        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'role' => 'required',
        // ]);

        // //dd($request->all());
        // $name = $request->name;
        // $email = $request->email;
        // $password = $request->password;

        // $user = new User();
        // $user->name = $name;
        // $user->email = $email;
        // $user->password = $password;
        // $user->save();

        // $roles = $request->input('roles'); // array of selected role IDs

        // $user->syncRoles($roles); // Assign roles to the user

        // return redirect(url('user-listing'))->with('success','User Added Successfully');
    }

    public function edit($id)
    {
        $users = User::find($id);
        $roles = Role::get();
        // $userRole = $users->roles->pluck('name','name')->all();
        $userRole = $users->roles->pluck('id')->toArray();

        // dd($users);
        // dd($userRole);

        return view('UserRegistrationView.EditUserForm',["users" => $users,"roles" => $roles,"userRole" => $userRole]);

    }

    public function update(Request $request, $id)
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

            //
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        // ]);

        // $id = $request->id;
        // $name = $request->name;
        // $email = $request->email;
        // $password = $request->password;

        // User::where('id','=',$id)->update([
        //     'name' => $name,
        //     'email' => $email,
        // ]);

        // return redirect(url('user-listing'))->with('success','User Updated Successfully');
    }

    public function destroy($id)
    {
        User::where('id','=',$id)->delete();

        return redirect()->back()->with('success','User Deleted Successfully');
    }


}
