<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    @include('layout/logo')

    <style>
        body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5; /* Light Gray */
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        position: relative; /* Make body a relative positioning context */
        }
        
        h2 {
            display: flex;
            justify-content: center;
            padding-bottom: 20px;
        }
        
        .registration-container {
            background-color: #ffffff; /* White */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333333; /* Dark Gray */
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #cccccc; /* Light Gray */
            border-radius: 4px;
            margin-bottom: 10px;
        }

        button {
            background-color: #4caf50; /* Green */
            color: #ffffff; /* White */
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .disabled {
            background-color: #cccccc; /* Light Gray */
            cursor: not-allowed;
        }

        .message-container {
        width: 300px;
        padding: 1px;
        box-sizing: border-box;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        text-align: center;
        position:absolute;
        top:5%;
        }

        .error {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #dc3545;
        }

        .success {
            color: #28a745;
            background-color: #d4edda;
            border: 1px solid #28a745;
        }

    </style>
</head>
<body>

<div>
    @if($errors->any())
        <div>
            @foreach($errors->all() as $error)
                <div class="message-container error">
                    <p>{{$error}}</p>
                </div>
            @endforeach
        </div>
    @endif

    @if(session()->has('error'))
        <div class="message-container error">
            <p>{{session('error')}}</p>
        </div>
    @endif

    @if(session()->has('success'))   
        <div class="message-container success">
            <p>{{session('success')}}</p>
        </div>
    @endif

</div>

<div class="registration-container">
    <h2>Register Giver</h2>

    <form id="registrationForm" action="{{route('registerGiver.post')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button id="submitButton" type="submit" disabled='true' class='disabled'>Register</button>

        <div>
            <p>Already have an account? <a href="{{route('loginGiver')}}">Login</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('registrationForm').addEventListener('input', function () {
        var fullNameValue = document.getElementById('fullName').value.replace(/\s+/g, ' ').trim();
        var emailValue = document.getElementById('email').value.replace(/\s+/g, ' ').trim();
        var passwordValue = document.getElementById('password').value.replace(/\s+/g, ' ').trim();
        var submitButton = document.getElementById('submitButton');

        if(fullNameValue !== '' && emailValue !== '' && passwordValue !== '') {
            submitButton.removeAttribute('disabled');
            submitButton.classList.remove('disabled');
        } 
        if(fullNameValue == '' || emailValue == '' || passwordValue == ''){
            submitButton.setAttribute('disabled', 'true');
            submitButton.classList.add('disabled');
        }
    });
</script>

</body>
</html>
