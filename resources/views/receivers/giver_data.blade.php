@include('receivers/receiversLayout/header')
<title>More Givers</title>

<style>
    table {
    width: 100%;
    margin-top: 20px;
    }

    thead{
        position:sticky;
        top:6.5%;
    }

    thead th, tbody td {
        top:0;
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    thead th {
        background-color: #f2f2f2;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f8;
    }

    tbody tr:nth-child(odd) {
        background-color: #d9d9d9;
    }

    td[colspan='8'] {
        text-align: center;
        padding: 10px;
    }

    /* Add spacing between table cells */
    table td, table th {
        padding: 10px;
    }

    /* Style the "No task" message */
    td[colspan='3'] {
        text-align: center;
        padding: 10px;
        color: #555; /* Adjust the color as needed */
    }

/* Style the search bar container */
.search-bar {
    width: 90%;
    margin: 1px auto; /* Center the search bar on the page */
}

/* Style the search input */
#searchInput {
    width: 70%; /* Adjust the width of the input field */
    padding: 8px; /* Add some padding for better appearance */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

/* Style the search button */
#searchButton {
    padding: 8px 12px; /* Adjust padding as needed */
    background-color: #4CAF50; /* Set a background color */
    color: white; /* Set text color */
    border: none; /* Remove border */
    cursor: pointer; /* Add a pointer cursor on hover */
}

/* Add hover effect to the search button */
#searchButton:hover {
    background-color: #45a049; /* Darken the background color on hover */
}

/* Responsive styling for small screens */
@media (max-width: 600px) {
    table {
        border: 1px solid #ddd;
    }

    table, thead, tbody, th, td, tr {
        display: block;
    }

    thead {
        display: none;
    }

    tr {
        margin-bottom: 10px;
        border: 1px solid #ddd;
    }

    td {
        border: none;
        position: relative;
        padding-left: 50%;
    }

    td:before {
        position: absolute;
        left: 6px;
        content: attr(data-label);
        font-weight: bold;
    }
    .search-bar {
        display: flex;
        align-items: center;
        margin: 10px;
        position:absolute;
        top:10%;
        left:21%;
        width:50%;
    }

    #searchInput {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    #searchButton {
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        padding: 8px;
        margin-left: 5px;
    }
    /* Style the search bar container */
.search-bar {
    width: 90%;
    margin: 1px auto; /* Center the search bar on the page */
}

/* Style the search input */
#searchInput {
    width: 70%; /* Adjust the width of the input field */
    padding: 8px; /* Add some padding for better appearance */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

/* Style the search button */
#searchButton {
    padding: 8px 12px; /* Adjust padding as needed */
    background-color: #4CAF50; /* Set a background color */
    color: white; /* Set text color */
    border: none; /* Remove border */
    cursor: pointer; /* Add a pointer cursor on hover */
}

/* Add hover effect to the search button */
#searchButton:hover {
    background-color: #45a049; /* Darken the background color on hover */
}


}
</style>

@include('layout/message')

<div class="search-bar">
    <form action="{{route('searchGiversReceiver')}}" method='get'>
        <input type="text" id="searchInput" name='searchGiver' placeholder="Search by name or email" value='{{$search}}'>
        <input type="submit" value='Search' id="searchButton">
    </form>
</div>

<main>
    <table>
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>More</th>
        </thead>
        <tbody>
            @forelse($givers as $giver)
            <tr>
            <td>{{$giver->name}}</td>
            <td>{{$giver->email}}</td>
           
            @if($giver->status == '1')
                <td>Active</td>
            @else
                <td>Inactive</td>
            @endif

            <td><a href="">View Profile</a></td>
                
            </tr>
            @empty
                <td colspan='3'>No givers to show</td>
            @endforelse
        </tbody>
    </table>

    {{$givers->links()}}
</main>

</body>
</html>