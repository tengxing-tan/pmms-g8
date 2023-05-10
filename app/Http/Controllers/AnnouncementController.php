<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {

        $announcements = Announcement::get();
        //return $announcements;
        //return view('AnnouncementView.AdminAnnouncementListingPage',compact('announcements'));
        return view('AnnouncementView.AdminAnnouncementListingPage', ["announcements" => $announcements]);
    }

    public function create()
    {

        return view('AnnouncementView.CreateAnnouncementForm');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        //dd($request->all());
        $title = $request->title;
        $description = $request->description;

        $ann = new Announcement();
        $ann->title = $title;
        $ann->description = $description;
        $ann->save();

        return redirect()->back()->with('success','Announcement Added Successfully');
        //return redirect(url('admin-announcement-list'));
    }

    public function edit($id)
    {
        $announcements = Announcement::where('id','=',$id)->first();

        return view('AnnouncementView.EditAnnouncementForm', ["announcements" => $announcements]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $id = $request->id;
        $title = $request->title;
        $description = $request->description;

        Announcement::where('id','=',$id)->update([
            'title' => $title,
            'description' => $description
        ]);

        //return redirect(url('announcement-list'));
        return redirect()->back()->with('success','Announcement Updated Successfully');
    }

    public function destroy($id)
    {
        Announcement::where('id','=',$id)->delete();

        return redirect()->back()->with('success','Announcement Deleted Successfully');
    }

    public function indexCommitteeAnnouncement()
    {

        $announcements = Announcement::get();

        return view('AnnouncementView.CommitteeAnnouncementListingPage', ["announcements" => $announcements]);
    }

    public function show($id)
    {

        // $announcements = Announcement::get();

        // return view('AnnouncementView.CommitteeAnnouncementListingPage', ["announcements" => $announcements]);

        $announcements = Announcement::where('id','=',$id)->first();

        // return $announcements;

        return view('AnnouncementView.AnnouncementDetailPage', ["announcements" => $announcements]);
    }
}
