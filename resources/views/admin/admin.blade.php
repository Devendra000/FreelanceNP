<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            bottom:8%;
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
@include('admin/header')
@include('admin/dashboard')

@include('layout/message')
</body>
</html>
</body>
</html>
