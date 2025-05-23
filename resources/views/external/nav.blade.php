<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom" style="font-weight: 700;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}" style="color: #0056D2;">
            enLearners
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold text-dark" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-dark" href="{{ url('/search') }}">Search</a>
                </li>

                @if (session()->has('user_id'))
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/questions') }}">Q&A Hub</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/openai') }}">Knowi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/books') }}">Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/resources/create') }}">Contribute</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/update-info') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/logout') }}">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/books') }}">Open Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-primary" href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-primary" href="{{ url('/signup') }}">Signup</a>
                    </li>
                @endif

                @if (session()->has('user_email'))
                    @php $user_email = session('user_email'); @endphp
                    @if (in_array($user_email, ['super_admin@gmail.com', 'resource_admin@gmail.com', 'topic_admin@gmail.com']))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold text-dark" href="#" id="actionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ url('/resources/create') }}">
                                        Add Resource
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/admin/resources') }}">
                                        Resources
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/admin/topics/create') }}">
                                        Add Topic
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/admin/topics') }}">
                                        Topics
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/admin/resource-requests') }}">
                                        Pending Requests
                                    </a>
                                </li>
                            </ul>
                        </li>

                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>
