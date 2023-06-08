<x-app-layout>
    <x-slot:title>Create Announcement</x-slot>

    <div class="p-6">
        <form class="mx-auto p-4 w-full max-w-4xl bg-white rounded-lg" method="post" action="{{url('save-announcement')}}">
            <h1 class="col-span-6 text-3xl font-semibold text-blue-800 mb-4">Create New Announcement</h1>
            @csrf
            <div class="md-3">
                <label class="form-lebel">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{old('title')}}">
                @error('title')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>
            <br>
            <div class="md-3">
                <label class="form-lebel">Description</label>
                <textarea class="form-control" name="description" placeholder="Enter Description" rows="4" cols="50">{{old('description')}}</textarea>
                @error('description')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div><br>
            <div class="flex">
                <button class="bg-amber-500 hover:bg-amber-700 text-white font-medium p-2 px-4 rounded" >Save</button>
                <button class="block cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-500 font-medium p-2 px-4 rounded"><a href="{{url('admin-announcement-list')}}" >Back</a></button>
            </div>
        </form>
    </div>

</x-app-layout>
