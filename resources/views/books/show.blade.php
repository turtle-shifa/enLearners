<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book['title'] ?? 'Book Details' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>
    @include('external.nav')
    <div class="container mt-5">
        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-4">← Back to Search</a>

        <h1>{{ $book['title'] }}</h1>

        @if(isset($book['description']))
            <p><strong>Description:</strong><br>
                {{ is_array($book['description']) ? $book['description']['value'] : $book['description'] }}
            </p>
        @endif

        @if(isset($book['subject']))
            <p><strong>Subjects:</strong> {{ implode(', ', $book['subject']) }}</p>
        @endif

        @if(isset($book['created']['value']))
            <p><strong>Created:</strong> {{ \Carbon\Carbon::parse($book['created']['value'])->toFormattedDateString() }}</p>
        @endif

        <p><strong>Open Library Work ID:</strong> {{ $book['key'] }}</p>

        <!-- Book Preview Embedding -->
        @if(isset($editionKey))
            <h4 class="mt-4">Preview</h4>
            <iframe
                src="https://openlibrary.org{{ $editionKey }}/preview"
                width="100%"
                height="600px"
                frameborder="0"
                allowfullscreen>
            </iframe>
        @else
            <p>Preview not available for this book.</p>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
