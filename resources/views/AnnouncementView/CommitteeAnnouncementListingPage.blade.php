<x-app-layout>
    <x-slot>Announcement List</x-slot>

    <div class="container" style="margin-top:20px">
        <div class="row">
            <div class="col-md-12">
                <h2>Announcement Board</h2>
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
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
                            <td><a href="{{url('view-announcement/'.$ann->id)}}" class="btn btn-primary">View</a>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>