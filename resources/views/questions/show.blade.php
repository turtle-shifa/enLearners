<!-- resources/views/questions/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $question->question }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>
    @include('external.nav') <!-- Include your external navigation bar -->

    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $question->question }}</h5>
                <p class="card-text">Asked by: {{ $question->user->name }}</p>
            </div>
        </div>

        <h3>Answers:</h3>

        <!-- Display all answers -->
        @foreach($question->answers as $answer)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{ $answer->answer }}</p>
                    <p class="card-text"><small class="text-muted">Answered by: {{ $answer->user->name }}</small></p>

                    <div class="d-flex">
                        <!-- Upvote button -->
                        <form action="{{ url('/answers/' . $answer->id . '/upvote') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary me-2">
                                <i class="bi bi-arrow-up-circle"></i> Upvote ({{ $answer->upvotes }})
                            </button>
                        </form>

                        <!-- Downvote button -->
                        <form action="{{ url('/answers/' . $answer->id . '/downvote') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-down-circle"></i> Downvote ({{ $answer->downvotes }})
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Post New Answer -->
        <form action="{{ url('/questions/' . $question->id . '/answer') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="answer" class="form-label">Your Answer</label>
                <textarea name="answer" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit Answer</button>
        </form>
    </div>
</body>
</html>
