<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Resource Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('external.nav')
    
    <div class="container mt-5">
        <h2 class="mb-4">Pending Resource Requests</h2>

        @foreach($requests as $request)
            <div class="card mb-3 p-3">
                <h4>{{ $request->title }}</h4>
                <p>{{ $request->description }}</p>
                <img src="{{ asset($request->thumbnail) }}" alt="Thumbnail" width="150">
                <p><strong>Resource Link:</strong> <a href="{{ $request->content }}" target="_blank">{{ $request->content }}</a></p>

                <!-- Grid layout for buttons -->
                <div class="row">
                    <div class="col">
                        <form action="{{ url('/admin/resource-requests/approve/'.$request->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-primary w-100">Approve</button>
                        </form>
                    </div>

                    <div class="col">
                        <form action="{{ url('/admin/resource-requests/reject/'.$request->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger w-100">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</body>
</html>
