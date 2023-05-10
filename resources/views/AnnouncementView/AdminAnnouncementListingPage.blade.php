<x-app-layout>
    <x-slot:title>Announcement List</x-slot>

    <div class="container" style="margin-top:20px">
        <div class="row">
            <div class="col-md-12">
                <h2>Announcement List</h2>
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <div style="margin-right:10%;float:right;">
                    <a href="{{url('create-announcement')}}" class="btn btn-primary">Create New Announcement</a>
                    {{--<a href="{{route('AnnouncementView.CreateAnnouncementForm')}}">Create New Announcement</a>--}}
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ( $announcements as $ann )
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$ann->title}}</td>
                            <td>{{$ann->description}}</td>
                            <td><a href="{{url('edit-announcement/'.$ann->id)}}" class="btn btn-primary">Edit</a> |
                                <a href="{{url('delete-announcement/'.$ann->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
  
</x-app-layout>