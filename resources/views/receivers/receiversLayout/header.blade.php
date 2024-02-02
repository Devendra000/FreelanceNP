<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/giversHeader.css')}}">
  <link rel="stylesheet" href="{{asset('css/message.css')}}">
  @include('layout/logo')
  
</head>
<body>

<header>
  <a href="{{route('homepageReceiver')}}">Home</a>
  <a href="{{route('viewProject')}}">Browse Projects(<div style='display:none'>{{$user = Auth::guard('receivers')->user()->receiver_id}}</div>{{App\Models\task::whereRaw("NOT JSON_CONTAINS(appliers,'[$user]')")->where('state','=',0)->count()}})</a>
  <a href="{{route('receiverProject')}}">Your projects({{App\Models\task::where('receiver_id','=',Auth::guard('receivers')->user()->receiver_id)->count()}})</a>
  <a href="{{route('receiverApplied')}}">Applied projects(<div style='display:none'>{{$user = Auth::guard('receivers')->user()->receiver_id}}</div>{{App\Models\task::whereRaw("JSON_CONTAINS(appliers,'[$user]')")->count()}})</a>
  <a href="">Find Help</a>
  <a href="{{route('showGivers')}}">Find Givers</a>
  <a href="">Talk to us</a>
  <a href="{{route('logoutReceiver')}}" style='float:right'>Log Out</a>
</header>