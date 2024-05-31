<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User</title>
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
            <h1 class="text-center mt-5">User</h1>
            <div class="mb-3 text-center">
                <a href="{{ route('welcome') }}" class="btn btn-primary">Home</a>
                <a href="{{ route('user.plan') }}" class="btn btn-primary">User Plans</a>
            </div>
        </div>
    </body>
    </html>