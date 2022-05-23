<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
    <title>Login</title>

    <style>
        #login-form {
        margin: auto;
        width: 30%;
        }
        #inner{
            padding: 10px;
            border: 3px solid #eee;
        }

    </style>
</head>
<body>
    <div id="login-form">
        <div id="inner" class="mt-5">
            <div class="mb-5"><h4 class="text-center">SmartFM</h4></div>
            <form>
                <!-- Email input -->
                <div class="form-outline mb-4">
                <input type="email" id="form2Example1" class="form-control bg-white" />
                <label class="form-label" for="form2Example1">Email address</label>
                </div>
            
                <!-- Password input -->
                <div class="form-outline mb-4">
                <input type="password" id="form2Example2" class="form-control" />
                <label class="form-label" for="form2Example2">Password</label>
                </div>
            
                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4 d-none">
                <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                    </div>
                </div>
            
                <div class="col">
                    <!-- Simple link -->
                    <a href="#!">Forgot password?</a>
                </div>
                </div>
            
                <!-- Submit button -->
                <button type="button" class="btn btn-primary btn-block mb-4 w-100">Sign in</button>
            
                <!-- Register buttons -->
                <div class="text-center">
                <p>Not a member? <a href="{{ route('register') }}">Register</a></p>

                <div class="d-none">
                    <p>or sign up with:</p>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>
                
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>
                
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-github"></i>
                    </button>
                </div>

                </div>
            </form>
        </div>
    </div>
</body>
</html>