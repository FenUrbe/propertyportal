<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Plans</title>
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
            <div class="col-12">
                <h1 class="text-center mb-5">User Plans</h1>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Plan</th>
                                    <th>Billing Frequency</th>
                                    <th>Number of Posts</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ $plan->length }}</td>
                                        <td>{{ $plan->description }}</td>
                                        <td>₱ {{ number_format($plan->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="{{ route('paypal.create') }}" method="POST">
                @csrf
                <div class="row justify-content-center mt-4">
                    <div class="col-sm-12 col-md-6 m-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="row align-items-center">      
                                    <div class="col">                         
                                        <select class="form-select" aria-label="Select plan" name="plan_id">
                                            <option selected disabled>Select Plan</option>
                                            @foreach($plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->name }} - ₱ {{ number_format($plan->price, 2) }} / {{ $plan->length }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Proceed Payment in Paypal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <div class="mt-3 text-center">
                    <a href="{{ route('welcome') }}" class="btn btn-primary">Home</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
