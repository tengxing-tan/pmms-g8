<x-app-layout>
    <div>
        <h1>Manage Inventory</h1>
        <div>
            <a href="{{ route('inventory.create') }}"> Create New inventory</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div>
        <p>{{ $message }}</p>
    </div>
    @endif

    <table>
        <tr>
            <th>No</th>
            <th>opening</th>
            <th>closing</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($inventories as $inventory)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $inventory->opening_quantity }}</td>
            <td>{{ $inventory->closing_quantity }}</td>
        </tr>

        <td>
            <form action="{{ route('inventory.destroy',$inventory->inventory_id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('inventory.show',$inventory->inventory_id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('inventory.edit',$inventory->inventory_id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </td>
        @endforeach
</x-app-layout>