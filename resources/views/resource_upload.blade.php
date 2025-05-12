<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resource</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>
    @include('external.nav')

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

    <div class="container mt-5">
        <div class="card shadow p-4" style="max-width: 600px; margin: auto;">
            <h3 class="text-center mb-4 fw-bold" style="color: #0056D2;">Upload New Resource</h3>

            <form action="{{ url('/resources') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Optional"></textarea>
                </div>

                <!-- Thumbnail -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Thumbnail Image</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*" required>
                </div>

                <!-- Resource URL -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Resource Link (Docs, YouTube, Drive, etc.)</label>
                    <input type="url" name="content" class="form-control" placeholder="Paste your link here" required>
                </div>

                <!-- Uploader (auto-filled) -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Uploader</label>
                    <input type="text" class="form-control" value="{{ session('user_name') }}" readonly>
                </div>

                <!-- Topic Dropdown -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Select Topic</label>
                    <select name="topic_id" class="form-select" required>
                        @foreach($topics as $topic)
                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit -->
                <div class="d-grid">
                    <button type="submit" class="btn" style="background-color: #0056D2; color: white; font-weight: bold;">Upload Resource</button>
                </div>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
