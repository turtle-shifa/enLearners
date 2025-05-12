<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search | Open Library</title>
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
        <h2 class="mb-4 fw-bold text-primary">Search Books</h2>

        <!-- Search Form -->
        <form action="{{ route('books.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Enter book title..." value="{{ $query ?? '' }}" required>
                <button class="btn btn-primary fw-bold">Search</button>
            </div>
        </form>

        @isset($books)
            @if(count($books) > 0)
                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                @if(isset($book['cover_i']))
                                    <img src="https://covers.openlibrary.org/b/id/{{ $book['cover_i'] }}-L.jpg" class="card-img-top" alt="Book Cover">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('books.show', ltrim($book['key'], '/works/')) }}">
                                            {{ $book['title'] }}
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        Author: {{ $book['author_name'][0] ?? 'Unknown' }}<br>
                                        First Published: {{ $book['first_publish_year'] ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No results found for "{{ $query }}".</p>
            @endif
        @endisset
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
