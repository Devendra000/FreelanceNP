@include('admin/admin')
<div class="search-bar">
        <form action="/admin/searchGiver">
            <input type="text" id="searchInput" name='searchGiver' placeholder="Search by name or email" value='{{$search}}'>
            <input type="submit" value='Search' id="searchButton">
        </form>
        <a href="{{route('viewTrash')}}">
            <button id="trashButton"> View Trash</button>
        </a>
    </div>

@include('admin/admin_panel')
@forelse($givers as $giver)
    <tr>
        <td>{{$giver->giver_id}}</td>
        <td>{{$giver->name}}</td>
        <td>{{$giver->email}}</td>
        <td>Giver</td>
        <td>
            <button class="edit-button">Edit</button>
            <a href="{{route('trashGiver',['id'=>$giver->giver_id])}}">
                <button class="trash-button">Trash</button>
            </a>
        </td>
        
        @if($giver->status == 1)
            <td>Active</td>
        @else
            <td>Inactive</td>
        @endif
        <td>
            <!-- Add more information as needed -->
            <a href="{{route('giverPublicProfile',['id'=>$giver->giver_id])}}">Details</a>
        </td>
    </tr>
@empty
    <tr><td colspan='7'>No givers to show</td></tr>
@endforelse

</table>

{{$givers->links()}}
</body>
</html>