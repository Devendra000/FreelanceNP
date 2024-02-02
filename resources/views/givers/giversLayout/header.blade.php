<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{asset('/storage/logo.png')}}">
  <link rel="stylesheet" href="{{asset('css/giversHeader.css')}}">
  <link rel="stylesheet" href="{{asset('css/message.css')}}">
  @include('layout/logo')
  
</head>
<body>

<header>
  <a href="{{route('homepageGiver')}}">Home</a>
  <a href="{{route('uploadProject')}}">Upload Project</a>
  <a href="{{route('myProjects')}}">Your projects</a>
  <a href="{{route('completedProjects')}}">Completed Projects</a>
  <a href="{{route('showReceivers')}}">Find Freelancers</a>
  <a href="">Talk to us</a>
  <a href="{{route('logoutGiver')}}" style='float:right'>Log Out</a>
</header>