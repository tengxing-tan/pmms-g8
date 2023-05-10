<x-app-layout>
    <x-slot:title>Create Announcement</x-slot>

        <div class="container" style="margin-top:20px">
            <div class="row">
                <div class="col-md-12">
                    <h2>Edit Announcement</h2>
                    @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    <form method="post" action="{{url('update-announcement')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$announcements->id}}">
                        <div class="md-3">
                            <label class="form-lebel">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{$announcements->title}}">
                            @error('title')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="md-3">
                            <label class="form-lebel">Description</label>
                            <textarea class="form-control" name="description" placeholder="Enter Description" rows="4" cols="50">{{$announcements->description}}</textarea>
                            @error('description')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div><br>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{url('admin-announcement-list')}}" class="btn btn-danger">Back</a>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>