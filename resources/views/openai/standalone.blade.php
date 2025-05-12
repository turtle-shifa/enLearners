<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Knowi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
    .chat-history-item:hover {
        background-color: #f1f1f1;
    }
    .question-preview {
        font-weight: 500;
        font-size: 14px;
    }
    .history-timestamp {
        font-size: 12px;
        color: gray;
    }
    pre {
        white-space: pre-wrap; 
        word-wrap: break-word;
        word-break: break-word;
        text-align: left;
    }
    body {
        font-family: 'Montserrat', sans-serif;
    }

</style>
</head>
<body>
    @include('external.nav')
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 border-end">
                <h5 class="mb-3 fw-normal">History</h5>
                <a href="{{ route('openai.form') }}" class="btn btn-success w-100 mb-3 fw-semibold">+ New Chat</a>
                <ul class="list-group">
                    @forelse ($histories ?? [] as $chat)
                        <a href="{{ route('openai.history', $chat->id) }}" class="list-group-item list-group-item-action chat-history-item">
                            <div class="question-preview">{{ \Illuminate\Support\Str::limit($chat->question, 50) }}</div>
                            <div class="history-timestamp">{{ $chat->created_at->diffForHumans() }}</div>
                        </a>
                    @empty
                        <li class="list-group-item">No history found</li>
                    @endforelse
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 mb-4">
                <img src="{{ asset('images/knowi.png') }}" alt="OpenRouter Logo" style="width: 300px; height: auto;">
                <div>
                    <br>
                </div>
                <!-- Show answer -->
                @if(session('answer') || isset($selectedAnswer))
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 fw-bold">Question</h5>
                        </div>
                        <div class="card-body">
                            <p class="fw-semibold">{{ session('question') ?? $selectedQuestion }}</p>
                        </div>
                        <div class="card-footer">
                            <h5 class="fw-bold">Answer:</h5>
                            <pre class="mb-0 fw-semibold">{{ session('answer') ?? $selectedAnswer }}</pre>
                        </div>
                    </div>
                @endif

                <!-- Show form only if not viewing history -->
                @if(!isset($selectedQuestion))
                    <form method="POST" action="{{ route('openai.ask') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="question" class="form-label fw-semibold">Ask Your Query:</label>
                            <textarea name="question" id="question" class="form-control" rows="4" placeholder="Ask anything related to your studies..." required>{{ old('question') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary fw-semibold">Ask</button>
                    </form>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        @foreach($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
