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

        <h3 class="mb-4 fw-bold text-primary">Answers:</h3>

        <!-- Display all answers -->
        @foreach($question->answers as $answer)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text fw-normal">{{ $answer->answer }}</p>

                    @if ($answer->images)
                        <div class="mt-2">
                            @foreach ($answer->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail me-2 mb-2" style="max-height: 150px;">
                            @endforeach
                        </div>
                    @endif
                    <p class="card-text"><small class="text-muted fw-normal">Answered by: {{ $answer->user->name }}</small></p>
                    <!--score-->
                    <p class="text-success fw-bold">
                        Score: {{
                            ($answer->upvotes + $answer->downvotes) > 0
                            ? round(($answer->upvotes / ($answer->upvotes + $answer->downvotes)) * log($answer->upvotes + $answer->downvotes + 1), 2)
                            : 0
                        }}
                    </p>

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
                        @if(session('user_email') === 'super_admin@gmail.com')
                            <form action="{{ route('answers.destroy', $answer->id) }}" method="POST" class="ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Answer</button>
                            </form>
                        @endif                    
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Post New Answer -->
        <form action="{{ url('/questions/' . $question->id . '/answer') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="mb-3">
                <label for="answer" class="form-label fw-normal">Your Answer</label>
                <textarea name="answer" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Upload Images (max 5):</label>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
            </div>
            <button type="submit" class="btn btn-success fw-bold">Submit Answer</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
