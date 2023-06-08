<x-app-layout>
    <x-slot:title>Edit User</x-slot>


    <div class="p-6">
        <form class="mx-auto p-4 w-full max-w-4xl bg-white rounded-lg" method="post" action="{{url('update-user', $users->id)}}">
            <h1 class="col-span-6 text-3xl font-semibold text-blue-800 mb-4">Edit User</h1>
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{$users->id}}">
            <div class="md-3">
                <label class="form-lebel">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$users->name}}">
                @error('name')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div><br>
            <div class="md-3">
                <label class="form-lebel">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter Email" rows="4" cols="50" value="{{$users->email}}">
                @error('email')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div><br>
            <div class="md-3">
                <label for="roles">Roles</label>
                    @foreach($roles as $role)
                        <div>
                            {{-- <input type="checkbox" name="roles[]" value="{{ $role->id }}"> {{ $role->name }} --}}
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, $userRole) ? 'checked' : '' }}> {{ $role->name }}
                            {{-- <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ isset($userRole) && in_array($role->id, $userRole) ? 'checked' : '' }}> {{ $role->name }} --}}
                        </div>
                     @endforeach
                    @error('roles[]')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
            </div><br>

            <div class="flex">
                <button class="bg-amber-500 hover:bg-amber-700 text-white font-medium p-2 px-4 rounded" >Save</button>
                <button class="block cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-500 font-medium p-2 px-4 rounded"><a href="{{url('user-listing')}}" >Back</a></button>
            </div>
        </form>
    </div>

</x-app-layout>
