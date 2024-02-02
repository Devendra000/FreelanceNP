@include('receivers/receiversLayout/header')
<title>Receiver Profile</title>
<link rel='stylesheet' href="{{asset('css\giverProfile.css')}}">
@include('layout/message')

<main>
    <div class="profile-container">
    <div class="profile-picture-container">
            <div class="profile-picture">
              <img id="image-preview" src="{{asset('storage/receivers/').'/'.Auth::guard('receivers')->user()->images}}" alt="Profile Picture">
            </div>
            <form action="{{route('uploadReceiver')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="image-upload" id='submitLabel' class="custom-upload-button">Upload picture</label>
        <input type="file" name="file" id="image-upload" accept="image/*" onchange="previewImage()">

        <button type="submit" class='upload-button' id="uploadButton" style="display: none;">Upload this picture</button>
    </form>
        </div>
        <br><br>
        <div class="profile-info">
        <form method='post' action="{{route('updateReceiver')}}"> 
          @csrf

            <h2 id="name" ondblclick="enableEdit('name')">{{Auth::guard('receivers')->user()->name}}</h2>
            <br>
            <p>Email: <span id="email" ondblclick="enableEdit('email')">{{Auth::guard('receivers')->user()->email}}</span> </p>
            <p>User since: {{Auth::guard('receivers')->user()->created_at}}</p>
        </div>
        
        
        <div class="update-profile">
            <input type='submit' class="update-button" value='Update'>
        </div>
      </form> 
    </div>
</main>

@include('receivers/receiversLayout/footer')   

<script>
  function previewImage() {
      const input = document.getElementById('image-upload');
      const preview = document.getElementById('image-preview');
      const uploadButton = document.getElementById('uploadButton');
      const submitLabel = document.getElementById('submitLabel');

      if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {
              preview.src = e.target.result;
              preview.style.display = 'block';
              uploadButton.style.display = 'inline';
              submitLabel.innerHTML = 'Select another picture';
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>

<script>
  function enableEdit(fieldId) {
    var element = document.getElementById(fieldId);
    
    // Create an input element
    var inputElement = document.createElement('input');

    // Set the type, value, and placeholder attributes
    if(fieldId=='email'){
      inputElement.type = 'email';
    }else{
      inputElement.type = 'text';
    }
    inputElement.value = element.innerText.trim()||element.innerHTML.trim();
    inputElement.placeholder = element.innerText.trim()||element.innerHTML.trim();
    inputElement.name = fieldId;
    
    // Set the id and class attributes
    inputElement.id = fieldId + 'Input';
    inputElement.className = 'update-info-input';
    
    // Replace the original element with the input element
    element.parentNode.replaceChild(inputElement, element);

    // Focus on the input element
    inputElement.focus();
    
    // Add an event listener to handle blur (when focus is lost)
    inputElement.addEventListener('blur', function() {
        // Replace the input element with the original element
        element.innerText = inputElement.value || inputElement.placeholder;
        element.parentNode.replaceChild(element, inputElement);
    });
  }
</script>


</body>

</html>