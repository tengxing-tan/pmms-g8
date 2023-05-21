<x-app-layout>
    <x-slot:title>User List</x-slot>



    <div class="p-6 w-full max-w-4xl mx-auto" x-data="{ openPopMesg: true }">
        <!-- success message -->
        @if ($message = Session::get('success'))
        <div class="px-4 py-2 mb-4 flex justify-between items-center w-full bg-green-400 text-gray-50 font-bold" x-show="openPopMesg" x-transition>
            <p>{{ $message  }}</p>
            <button class="flex items-center" x-on:click="openPopMesg = false">
                <span class="material-symbols-outlined font-medium">close</span>
            </button>
        </div>
        @endif

        <div class="grid grid-cols-12 items-center w-full">
            <h1 class="col-span-6 text-3xl font-semibold text-gray-800">User List</h1>
            <div class="col-span-6 justify-self-end">
                <a class="py-2 px-4 rounded bg-amber-500 hover:bg-amber-700 font-medium text-white cursor" href="{{url('create-user')}}"> Create New User</a>
            </div>
        </div>

        <div class="p-6 w-full max-w-4xl mx-auto bg-white text-gray-700 rounded-lg">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email address</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ( $users as $user )
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                              @foreach($user->getRoleNames() as $v)
                                {{ $v }}
                                 {{-- <label class="badge badge-success">{{ $v }}</label> --}}
                              @endforeach
                            @endif
                          </td>
                        <td><a href="{{url('edit-user/'.$user->id)}}" class="btn btn-primary">Edit</a> |
                            <a href="{{url('delete-user/'.$user->id)}}" class="btn btn-danger">Delete</a>

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
