<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $users = User::get();
        //return $announcements;
        //return view('AnnouncementView.AdminAnnouncementListingPage',compact('announcements'));
        return view('UserRegistrationView.UserListingPage', ["users" => $users]);
    }

    public function create()
    {

        return view('UserRegistrationView.RegistrationForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        //dd($request->all());
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        return redirect(url('user-listing'))->with('success','User Added Successfully');
    }

    public function edit($id)
    {
        $users = User::where('id','=',$id)->first();

        return view('UserRegistrationView.EditUserForm', ["users" => $users]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        User::where('id','=',$id)->update([
            'name' => $name,
            'email' => $email,
        ]);

        return redirect(url('user-listing'))->with('success','User Updated Successfully');
    }

    public function destroy($id)
    {
        User::where('id','=',$id)->delete();

        return redirect()->back()->with('success','User Deleted Successfully');
    }
}
