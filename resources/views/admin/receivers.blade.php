@include('admin/admin')

<div class="search-bar">
        <form action="/admin/searchReceiver">
            <input type="text" id="searchInput" name='search' placeholder="Search by name or email" value='{{$search}}'>
            <input type="submit" value='Search' id="searchButton">
        </form>
        <a href="{{route('viewTrash')}}">
            <button id="trashButton"> View Trash</button>
        </a>
    </div>

@include('admin/admin_panel')

@forelse($receivers as $receiver)
    <tr>
        <td>{{$receiver->receiver_id}}</td>
        <td>{{$receiver->name}}</td>
        <td>{{$receiver->email}}</td>
        <td>Receiver</td>
        <td>
            <button class="edit-button">Edit</button>
            <a href="{{route('trashReceiver',['id'=>$receiver->receiver_id])}}">
                <button class="trash-button">Trash</button>
            </a>
        </td>
        @if($receiver->status == '1')
            <td>Active</td>
        @else
            <td>Inactive</td>
        @endif
        <td>
            <!-- Add more information as needed -->
            <a href="{{route('receiverPublicProfile',['id'=>$receiver->receiver_id])}}">Details</a>
        </td>
    </tr>
    @empty
        <tr><td colspan='7'>No receivers to show</td></tr>
    @endforelse
</table>

{{$receivers->links()}}
</body>
</html>