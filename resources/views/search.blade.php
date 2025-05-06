<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search by Topic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h3 class="mb-4 fw-bold text-primary">Search Resources by Topic</h3>

        <form>
            <div class="mb-3">
                <label for="topic" class="form-label fw-semibold">Choose a Topic:</label>
                <select class="form-select" id="topic" onchange="if(this.value) window.location.href='/topic/' + this.value">
                    <option selected disabled>-- Select a topic --</option>
                    @foreach($topics as $topic)
                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</body>
</html>
