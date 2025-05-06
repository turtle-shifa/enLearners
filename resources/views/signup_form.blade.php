<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup-enLearners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
    }
    </style>
</head>
<body>
    <!-- navigation bar added here -->
    @include('external.nav')

    <main>
        <!-- Signup Form -->
        <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card shadow-sm p-4" style="width: 100%; max-width: 450px; border-top: 4px solid #0056D2;">
                <h3 class="text-center mb-4 fw-bold" style="color: #0056D2;">Create Account</h3>

                <form method="POST" action="{{ url('/users') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Enter your full name" value="{{ old('name') }}" required>

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="Enter your email" value="{{ old('email') }}" required>

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Enter your password" required>

                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" placeholder="Confirm your password" required>
                    </div>

                    <!-- Submit -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn" style="background-color: #0056D2; color: white; font-weight: bold;">
                            Sign Up
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="text-center mt-3">
                    <small>Already have an account? <a href="{{ url('/login') }}" class="text-decoration-none" style="color: #0056D2;">Login here</a></small>
                </div>
            </div>
        </div>
    </main>

</body>
</html>