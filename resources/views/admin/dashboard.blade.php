<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @include('layout/logo')
    <link rel="stylesheet" href="{{ asset('css/adminDashboard.css') }}">
</head>
<body>

    
    <div class="container">
        <div class="sidebar">
            <h2>Statistics</h2>
            <div class="statistic">
                <p>Total Users: <span> {{App\Models\giver::count()+App\Models\receiver::count()}} </span></p>
            </div>

            <h3>Givers</h3>
            <div class="statistic">
                <p>Total Givers: <span> {{App\Models\giver::count()}} </span></p>
            </div>
            <div class="statistic">
                <p>Active Givers: <a href="{{route('activeGivers')}}" title='Show all ACTIVE Givers'><span> {{App\Models\giver::where('status','=','1')->count()}} </span></a></p>
            </div>
            <div class="statistic">
                <p>Inactive Givers: <span> {{App\Models\giver::where('status','=','0')->count()}} </span></p>
            </div>

            <h3>Receivers</h3>
            <div class="statistic">
                <p>Total Receivers: <span> {{App\Models\receiver::count()}} </span></p>
            </div>
            <div class="statistic">
                <p>Active Receivers: <a href="{{route('activeReceivers')}}" title='Show all ACTIVE Receivers'><span> {{App\Models\receiver::where('status','=','1')->count()}} </span></a></p>
            </div>
            <div class="statistic">
                <p>Inactive Receivers: <span> {{App\Models\receiver::where('status','=','0')->count()}} </span></p>
            </div>

            <h3>Tasks</h3>
            <div class="statistic">
                <p>Total Work Not accepted yet: <span> {{App\Models\task::where('state','=','0')->count()}} </span></p>
            </div>
            <div class="statistic">
                <p>Total Work in Progress: <span> {{App\Models\task::where('state','=','1')->count()}} </span></p>
            </div>
            <div class="statistic">
                <p>Total Work Completed: <span> {{App\Models\task::where('state','=','2')->count()}} </span></p>
            </div>
            
        </div>

    </div>
</body>
</html>
