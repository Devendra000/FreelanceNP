<div>
    @if($errors->any())
        <div>
            @foreach($errors->all() as $error)
                <div class="message-container error">
                    <p>{{$error}} <a class='hide' onclick = hide() style='border:1px solid green; background:green; color:white; margin-left:10%; cursor:pointer; border-radius:5px;'>X</a></p>
                </div>
            @endforeach
        </div>
    @endif

    @if(session()->has('error'))
        <div class="message-container error">
            <p>{{session('error')}}<a class='hide' onclick = hide() style='border:1px solid green; background:green; color:white; margin-left:10%; cursor:pointer; border-radius:5px;'>X</a></p>
        </div>
    @endif

    @if(session()->has('success'))   
        <div class="message-container success">
            <p>{{session('success')}}<a class='hide' onclick = hide() style='border:1px solid green; background:green; color:white; margin-left:10%; cursor:pointer; border-radius:5px;'>X</a></p>
        </div>
    @endif

</div>


<script>
    function hide(){
        document.querySelector(".message-container").style.display='none';
    }
</script>