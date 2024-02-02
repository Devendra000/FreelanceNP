@include('givers/giversLayout/header')
<title>Giver Homepage</title>

@include('layout/message')

<main>
  Welcome, <a href="{{route('profileGiver')}}">{{Auth::guard('givers')->user()->name}}</a><br><br>
  You've been the giver since: {{Auth::guard('givers')->user()->created_at}}<br>
</main>

@include('givers/giversLayout/footer')
<script link = "{{ asset('js/giverScript.js') }}">
  function hide(){
    document.querySelector(".message-container").style.display='none';
}
</script>
</body>
</html>