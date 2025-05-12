<!-- resources/views/questions/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Your Question</title>
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
        <h2 class="mb-4 fw-bold text-primary">Post Your Question</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display All Questions -->
        @foreach($questions as $question)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $question->question }}</h5>

                    <p class="card-text">Asked by: {{ $question->user->name }}</p>
                    
                    <a href="{{ route('questions.show', $question->id) }}" class="btn btn-primary fw-bold">View Answers</a>
                    @if(session('user_email') === 'super_admin@gmail.com')
                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger fw-bold">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Post New Question Form -->
        <form action="{{ url('/questions') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="question" class="form-label fw-bold">Your Question</label>
                <textarea name="question" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary fw-bold">Post Question</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
