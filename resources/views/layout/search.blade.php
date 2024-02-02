<div class="search-bar">
    <form action="">
        @csrf
        <input type="text" id="search" name='search' placeholder="Search by name or email or status" value="{{$search}}">
        <input type="submit" value='search'>
    </form>
</div>
