<x-app-layout>
    <x-slot:title>User List</x-slot>



    <div class="p-6 w-full max-w-4xl mx-auto" x-data="{ openPopMesg: true, openDelConfirm: false }">
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
            <h1 class="col-span-6 text-3xl font-semibold text-gray-800 mb-6">User List</h1>
            <div class="col-span-6 justify-self-end">
                <a class="py-2 px-4 rounded bg-amber-500 hover:bg-amber-700 font-medium text-white cursor" href="{{url('create-user')}}"> Create New User</a>
            </div>
        </div>

        <div class="p-6 w-full max-w-4xl mx-auto bg-white text-gray-700 rounded-lg">
            <table class="table">
                <thead>
                    <tr class="bg-gray-100 px-4 rounded-md mt-8 font-semibold text-gray-800">
                        <th>No</th>
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
                        <td>
                            <div class="flex items-center">
                                <a href="{{url('edit-user/'.$user->id)}}" class="bg-amber-500 hover:bg-amber-700 text-white font-medium p-2 px-4 rounded">Edit</a>
                                {{-- <a href="{{url('delete-user/'.$user->id)}}" class="btn btn-danger">Delete</a> --}}
                                <div>
                                    <button class="col-span-6 justify-self-end block py-2 px-4 rounded bg-rose-500 hover:bg-rose-700 font-medium text-white cursor ml-2" type="button" x-on:click="openDelConfirm = { id: {{ $user->id }} }">Delete</button>

                                    <form action="{{ url('delete-user/'.$user->id)}}" method="POST" x-show="openDelConfirm && openDelConfirm.id === {{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="absolute top-0 bottom-0 left-0 right-0 flex justify-center items-center">
                                            <div class="bg-white rounded shadow-2xl shadow-gray-500/50 p-12 px-24 flex flex-col items-center">
                                                <p class="text-xl font-bold text-gray-800 mb-6">Confirm to delete?</p>
                                                <div class="flex">
                                                    <input type="submit" value="Delete" class="block py-2 px-4 rounded bg-rose-500 hover:bg-rose-700 font-medium text-white cursor" />
                                                    <button class="ml-4 py-2 px-4 rounded bg-gray-500 hover:bg-gray-700 font-medium text-white cursor" type="button" x-on:click="openDelConfirm = false">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
