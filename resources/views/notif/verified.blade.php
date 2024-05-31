<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Email Verified</title>
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
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 text-center">
                    <h1 class="text-success">Email Verified</h1>
                    <p class="lead">Thank you for verifying your email</p>
                    <div class="mb-3 text-center">
                        <a href="{{ route('welcome') }}" class="btn btn-primary">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>