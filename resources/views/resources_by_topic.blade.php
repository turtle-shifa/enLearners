<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic Resources - enLearners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .card {
            background-color: #EFF6FF;
            box-shadow: 0 4px 8px rgba(90, 90, 90, 0.1);
        }

        .card-title {
            font-weight: bold;
        }

        .upvote-btn, .downvote-btn, .comment-btn, .save-btn {
            border: 1px solid transparent;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            border-radius: 10px; /* Makes the button rounded */
            height: 38px; /* Ensures all buttons have the same height */
            font-size: 14px; /* Adjusts the text size if needed */
        }

        .upvote-btn {
            background-color: #347e02;
            color: white;
        }

        .downvote-btn {
            background-color: #ff3600;
            color: white;
        }

        .comment-btn {
            background-color: rgb(22, 108, 121);
            color: white;
        }

        .save-btn {
            background-color:rgb(78, 121, 240); /* Change to desired background color */
            color: white;
        }

        .upvote-btn i, .downvote-btn i, .comment-btn i, .save-btn i {
            margin-right: 5px;
        }

        /* Adjust spacing between comment and save buttons */
        .d-flex .comment-btn {
            margin-right: 8px; /* Adds space between comment and save buttons */
        }

        .card img {
            border-radius: 0.25rem;
            width: 100%;
            height: auto;
        }
    </style>

</head>
<body>
    @include('external.nav')

    <main>
        <div class="container mt-5">
            <h2 class="mb-4 fw-bold">Resources for {{ $topicName }}</h2>

            @if($allResources->isEmpty())
                <p>No resources found for this topic.</p>
            @else
                <div class="row">
                    @foreach($allResources as $resource)
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <!-- Make the thumbnail clickable -->
                                        <a href="{{ $resource->content }}" target="_blank">
                                            <img src="{{ asset('/' . $resource->thumbnail) }}" class="img-fluid rounded-start" alt="Resource Thumbnail">
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <!-- Make the title clickable -->
                                            <a href="{{ $resource->content }}" target="_blank" class="card-title text-decoration-none">
                                                <h5 class="card-title">{{ $resource->title }}</h5>
                                            </a>
                                            <p class="card-text"><small class="fw-semibold">Added by {{ $contributors[$loop->index] }}</small></p>
                                            <div class="d-flex justify-content-start align-items-center">
                                                <a href="{{ url("/upvote/{$resource->id}") }}" class="upvote-btn btn btn-sm me-2">
                                                    <i class="fas fa-arrow-up"></i>
                                                    <span class="fw-semibold ms-1">{{ $resource->upvote }}</span>
                                                </a>

                                                <a href="{{ url("/downvote/{$resource->id}") }}" class="downvote-btn btn btn-sm me-2">
                                                    <i class="fas fa-arrow-down"></i>
                                                    <span class="fw-semibold ms-1">{{ $resource->downvote }}</span>
                                                </a>

                                                <button class="comment-btn btn btn-sm">
                                                    <i class="fas fa-comment-alt"></i>
                                                    <div class="fw-semibold">{{ $resource->comment }}</div>
                                                </button>

                                                <a href="{{ url("/save/{$resource->id}") }}" class="save-btn btn btn-sm">
                                                    <i class="fas fa-bookmark"></i>
                                                    <span class="fw-semibold">Save</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
