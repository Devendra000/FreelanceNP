@include('receivers/receiversLayout/header')
<title>Receiver Homepage</title>
<link rel="stylesheet" href="{{asset('css/receiverPost.css')}}">
<style>

.dashboard-container {
  position:fixed;
  top:10%;
  max-width: 600px;
      margin: 20px auto;
      
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}


.dashboard h2 {
  font-size: 1.2em;
  margin-bottom: 10px;
}

.dashboard-stats {
  list-style: none;
  padding: 0;
  margin: 0;
}

.dashboard-stat {
  margin-bottom: 10px;
}

.dashboard-stat-label {
  font-weight: bold;
  color: #333;
}

.dashboard-stat-value {
  color: #555;
}
    .post-container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .post-title {
      font-size: 1.5em;
      margin-bottom: 10px;
      
    }

    .post-urgent {
      font-size: 60%;
      padding:1px;
      color: #881111;
      border:1px solid #881111;
      border-radius:10%;
    }

    .post-notUrgent {
      font-size: 60%;
      padding:1px;
      border:1px solid #118811;
      border-radius:10%;
      color: #118811;
    }

    .post-details {
      display: flex;
      justify-content: space-around;
      margin-bottom: 10px;
    }

    .post-details-item {
      flex: 1;
      margin-right: 10px;
    }

    .post-details-label {
      font-weight: bold;
      color: #555;
    }

    .post-details-value {
      color: #333;
      white-space: nowrap;
    }

    .post-skills {
      margin-top: 10px;
    }

    .post-skills-label {
      font-weight: bold;
      color: #555;
      margin-bottom: 5px;
    }

    .post-skills-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-wrap: wrap;
    }

    .post-skill {
      background-color: #400909;
      color: #fff;
      padding: 5px 10px;
      margin-right: 5px;
      margin-bottom: 5px;
      border-radius: 5px;
    }
    

      @media (max-width: 1086px) {
      body {
        flex-wrap: wrap;
      }
      
      .dashboard-container {
        display:none;
      }
    }

</style>
@include('layout/message')

  <main>
    <div class="dashboard-container">
      <div class="dashboard">
        <h2>Dashboard</h2>
        <ul class="dashboard-stats">
          <li class="dashboard-stat">
            <span class="dashboard-stat-label">Name:</span>
            <span class="dashboard-stat-value"><a href="{{route('profileReceiver')}}">{{Auth::guard('receivers')->user()->name}}</a></span>
          </li>
          <li class="dashboard-stat">
            <span class="dashboard-stat-label">Total Tasks:</span>
            <span class="dashboard-stat-value">{{App\Models\task::where('receiver_id','=',Auth::guard('receivers')->user()->receiver_id)->count()}}</span>
          </li>
          <li class="dashboard-stat">
            <span class="dashboard-stat-label">Tasks To Do:</span>
            <span class="dashboard-stat-value">{{App\Models\task::where('receiver_id','=',Auth::guard('receivers')->user()->receiver_id)->where('state','=',1)->count()}}</span>
          </li>
          <li class="dashboard-stat">
            <span class="dashboard-stat-label">Tasks Completed:</span>
            <span class="dashboard-stat-value">{{App\Models\task::where('receiver_id','=',Auth::guard('receivers')->user()->receiver_id)->where('state','=',2)->count()}}</span>
          </li>
        </ul>
      </div>
    </div>

    @include('receivers/receiversLayout/post')
    
  </main>

<footer>
  <div class="social-icons">
    <a href="https://twitter.com/YourTwitter" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
    <a href="https://facebook.com/YourFacebook" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
    <a href="https://instagram.com/YourInstagram" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
  </div>
</footer>

</body>
</html>