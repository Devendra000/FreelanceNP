<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/adminDashboard.css') }}">
    @include('layout/logo')
    <style>
        .search-bar {
            display: flex;
            align-items: center;
            width: 50%;
            margin: 10px;
            position: absolute;
            top: 10%;
            left: 25%;
        }

        #searchInput {
            flex: 1;
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

        #trashButton {
            background-color: #ff5555;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            padding: 8px;
            margin-left: 5px;
            position:relative;
            left:80%;
            }

        .message-container {
            width: 300px;
            padding: 1px;
            box-sizing: border-box;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
            position:absolute;
            bottom:10%;
        }

        .error {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #dc3545;
        }

        .success {
            color: #28a745;
            background-color: #d4edda;
            border: 1px solid #28a745;
        }

        .table-container {
        position: absolute;
        top: 15%;
        left: 25%;
        }

        .admin-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-table th, .admin-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .admin-table th {
            background-color: #f2f2f2;
        }

        .admin-table tr:hover {
            background-color: #f5f5f5;
        }

        .edit-button, .trash-button {
            padding: 8px 12px;
            margin-right: 5px;
            cursor: pointer;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
        }

        .trash-button {
            background-color: #e74c3c;
        }

        /* Style for More Information link */
        .more-info-link {
            text-decoration: none;
            color: #3498db;
        }
        .container {
            text-align: left; /* Center align the content */
            width:
        }

        h2{
            color: #333; /* Text color for h2 */
            background-color: #eee; /* Background color for h2 */
            padding: 10px; /* Padding around the text for h2 */
            border-radius: 5px; /* Rounded corners for h2 */
        }
        .message-container {
            width: 300px;
            padding: 1px;
            box-sizing: border-box;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
            position:absolute;
            bottom:10%;
        }

        .error {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #dc3545;
        }

        .success {
            color: #28a745;
            background-color: #d4edda;
            border: 1px solid #28a745;
        }

    </style>
</head>
<body>
@include('admin/header');
    
    <div class="sidebar">
        <br><br>
        <h2>Trash</h2>
        <br><br>
        <p class='info'>All the deleted users are shown here. <br><br>To restore them click, 'Restore'<br><br> To delete them permanently, click 'Delete'</p>
    </div>
    

@if(session()->has('error'))
        <div class="message-container error">
            <p>{{session('error')}}</p>
        </div>
    @endif

    @if(session()->has('success'))   
        <div class="message-container success">
            <p>{{session('success')}}</p>
        </div>
    @endif

        

    <div class="search-bar">
        <form action="/admin/viewTrash/search">
            <input type="text" id="searchInput" name='search' placeholder="Search trash by name" value='{{$search}}'>
            <input type="submit" value='Search' id="searchButton">
        </form>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Action</th>
                <th>More Information</th>
            </thead>
            @foreach($givers as $giver)
                <tr>
                    <td>{{$giver->giver_id}}</td>
                    <td>{{$giver->name}}</td>
                    <td>{{$giver->email}}</td>
                    <td>Giver</td>
                    <td>
                        <a href="{{route('restoreGiver',['id'=>$giver->giver_id])}}">
                            <button class="edit-button">Restore</button>
                        </a>
                        <a href="{{route('deleteGiver',['id'=>$giver->giver_id])}}">
                            <button class="trash-button">Delete</button>
                        </a>
                    </td>
                    <td>
                        <!-- Add more information as needed -->
                        <a href="">Details</a>
                    </td>
                </tr>
            @endforeach
            
            @foreach($receivers as $receiver)
                <tr>
                    <td>{{ $receiver->receiver_id}}</td>
                    <td>{{$receiver->name}}</td>
                    <td>{{$receiver->email}}</td>
                    <td>Receiver</td>
                    <td>
                        <a href="{{route('restoreReceiver',['id'=>$receiver->receiver_id])}}">
                            <button class="edit-button">Restore</button>
                        </a>
                        <a href="{{route('deleteReceiver',['id'=>$receiver->receiver_id])}}">
                            <button class="trash-button">Delete</button>
                        </a>
                    </td>
                    <td>
                        <!-- Add more information as needed -->
                        <a href="">Details</a>
                    </td>
                </tr>
            @endforeach
        </table>

</body>
</html>
</body>
</html>
