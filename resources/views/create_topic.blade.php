<!-- resources/views/admin/create_topic.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Topic - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>
    @include('external.nav') <!-- Include your external navigation bar -->

    <div class="container mt-5">
        <h2 class="mb-4">Create New Topic</h2>

        <!-- Display Validation Errors -->
        @if (session('success'))
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="successToast" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        @if (session('user_email') == 'topic_admin@gmail.com' || session('user_email') == 'super_admin@gmail.com')
        <!-- Topic Creation Form -->
        <form action="/admin/topics" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Topic Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter topic name" value="{{ old('name') }}" required>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">Create Topic</button>
            </div>
        </form>

        <!-- Back to Topic Management -->
        <div class="mt-3">
            <a href="/admin/topics" class="text-decoration-none">Back to Topics</a>
        </div>

        @else
        <div class="container my-5">
            <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading">📢 Alert</h4>
                <hr>
                <ul class="mb-0">
                <p><h4>You are not authorized to access Topic section.</h4></p>

                </ul>
            </div>
        </div>
        @endif
    </div>
</body>
</html>
