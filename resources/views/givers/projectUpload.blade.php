@include('givers/giversLayout/header')
    <title>Upload project</title>
    <link rel='stylesheet' href="{{asset('css/projectUpload.css')}}">
    @include('layout/logo')

    @include('layout/message')

    <form action="{{route('uploadProjectPost')}}" method='post'>

        @csrf
        <input type="text" name='projectName' placeholder='projectName'><br>
        Deadline:<input type="date" name='deadline'  min="{{ date('Y-m-d') }}"><br>
        <select name='urgency'>
            <option value="0">Not urgent</option>
            <option value="1">Urgent</option>
        </select><br>
        <input type="number" name='pod' placeholder='Price of development'><br>
        
        <textarea rows='4' name='description' placeholder='description of project'></textarea><br>
        <input type="submit" value="Submit">
    </form>
    
</body>
</html>