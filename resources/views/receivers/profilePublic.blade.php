<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href="{{asset('css\giverProfile.css')}}">
    <title>Public Profile</title>
</head>
<body>
@include('givers/giversLayout/header')
<main>
    @if($user != null)
        <div class="profile-container">
            <div class="profile-picture-container">
                <div class="profile-picture">
                    <img id="image-preview" src="{{asset('storage/receivers/').'/'.$user->images}}" alt="Profile Picture Preview">
                </div>
            </div>
            <br><br>
            
            <div class="profile-info">
                <h2 id="name">{{$user->name}}</h2>
                <br>
                <p>Email: <span id="email">{{$user->email}}</span> </p>
            </div>
        </div>
        @else
            <div class="profile-info">
                <h2 id="name">No such user</h2>
                <a href="{{url()->previous()}}">Go back</a>
                <a href="{{route('loginGiver')}}">Home</a>
        @endif
</main>
</body>

</html>