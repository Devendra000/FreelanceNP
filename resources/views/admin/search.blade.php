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
    </style>
</head>
<body>
@include('admin/header');
@include('admin/dashboard');

<div class="search-bar">
    <form action="/search">
        @csrf
        <input type="text" id="search" name='search' placeholder="Search by name or email or status" value="{{$search}}">
        <input type="submit" value='search'>
    </form>
</div>

@include('admin/admin_panel');

