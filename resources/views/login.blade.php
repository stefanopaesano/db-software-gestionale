<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
    <link rel="stylesheet" href="css/style.css">
    @vite('resources/js/app.js')
    
</head>
<body>

    <div class="container">
        <div class="login-container">
            <form  class="form-login"   action="{{ route('login') }}" method="POST" class="login-form">
                @csrf
    
                <h2>Login</h2>
    
                <!-- Email -->
                <div class="form-group-login">
                    <label for="email">Email:</label>
                    <input id="email" type="email" name="email" required class="form-control @error('email') error @enderror">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
    
                <!-- Password -->
                <div class="form-group-login">
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password" required class="form-control @error('password') error @enderror">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
    
                <!-- Button -->
                <button type="submit" class="submit-btn">Login</button>
            </form>
        </div>
    </div>
    

</body>
</html>
