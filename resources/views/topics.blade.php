<!-- resources/views/admin/topics.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Topics</title>
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
        <h2 class="mb-4 fw-bold text-primary">Manage Topics</h2>

        <!-- Success Message -->
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
        <!-- Topics Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Topic Name</th>
                    <!-- <th scope="col">Description</th> -->
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topics as $topic)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $topic->name }}</td>
                        <!-- <td>{{ $topic->description }}</td> -->
                        <td>
                            <!-- Delete Button Form -->
                            <form action="/admin/topics/{{ $topic->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
