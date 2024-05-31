<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
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
                            <h1 class="card-title text-center mb-4">Log-in</h1>
                            <form method="post" action="{{route('user.checkInfo')}}" id="loginForm">
                                @csrf
                                @method('post')
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" />
                                </div>
                                <div class="mb-5">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-primary">Log-in</button>
                                    <a href="{{route('welcome')}}" class="btn btn-danger">Cancel</a>
                                </div>
                                <div class="mb-3">
                                    <a href="{{route('user.forgotPassword')}}" class="text-decoration-underline text-danger">Forgot Password</a>
                                </div>
                                <div class="mb-3">
                                    <a href="{{route('user.register')}}" class="text-decoration-underline text-primary">Don't Have An Account</a>
                                </div>
                                <div class="mb-3">
                                    <a href="{{route('google.login')}}" class="text-decoration-underline text-success">Login Using Google Account</a>
                                </div> 
                                <div class="mb-3">
                                    <a href="{{route('facebook.login')}}" class="text-decoration-underline text-success">Login Using Facebook Account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
