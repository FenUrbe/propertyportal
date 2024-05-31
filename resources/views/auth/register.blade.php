<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y4C8VL9SWD"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-Y4C8VL9SWD');
    </script>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title text-center mb-4">Register</h1>
                            <form method="post" action="{{route('user.saveInfo')}}" id="registerForm">
                                @csrf
                                @method('post')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>   
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"/>
                                </div>
                                <div class="mb-3">
                                    <label for="user_type" class="form-label">User Type</label>
                                    <select class="form-select" id="user_type" name="user_type">
                                        <option value="" disabled selected>Select User Type</option>
                                        <option value="1" {{ old('user_type') == '1' ? 'selected' : '' }}>Buyer</option>
                                        <option value="2" {{ old('user_type') == '2' ? 'selected' : '' }}>Seller</option>
                                        <option value="3" {{ old('user_type') == '3' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                    <button type="button" class="btn btn-secondary" onclick="clearFields()">Clear</button>
                                    <a href="{{route('welcome')}}" class="btn btn-danger">Cancel</a>
                                </div>
                                <div class="mb-3 text-center">
                                    <a href="{{route('user.login')}}" class="text-decoration-underline text-primary">Already Have An Account</a>
                                </div>
                                <div class="mb-3 text-center">
                                    <a href="{{route('google.login')}}" class="text-decoration-underline text-success">Login Using Google Account</a>
                                </div>
                                <div class="mb-3 text-center">
                                    <a href="{{route('facebook.login')}}" class="text-decoration-underline text-success">Login Using Facebook Account</a>
                                </div>
                                <script>
                                    function clearFields() {
                                        document.getElementById("registerForm").reset();
                                    }
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
