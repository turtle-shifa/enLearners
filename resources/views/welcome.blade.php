<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>enLearners</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8f9fc;
    }
    .hero {
      padding: 100px 0;
      background: linear-gradient(135deg, #0056D2, #0077FF);
      color: white;
    }
    .hero h1 {
      font-size: 3rem;
      font-weight: 700;
    }
    .hero p {
      font-size: 1.2rem;
      margin-top: 20px;
    }
    .hero-btn {
      margin-top: 30px;
      padding: 12px 30px;
      font-weight: 600;
      border-radius: 50px;
      background-color: white;
      color: #0056D2;
      transition: 0.3s;
      border: none;
    }
    .hero-btn:hover {
      background-color: rgb(55, 132, 255);
      color: white;
    }
    .hero-img {
      width: 130%;
      height: auto;
      max-width: none;
    }
    .feature-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 30px;
      border-radius: 20px;
      background: white;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      transition: transform 0.3s, box-shadow 0.3s;
      height: 100%;
    }
    .feature-box:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    .feature-icon {
      font-size: 3rem;
      color: #0056D2;
      margin-bottom: 20px;
    }
    .cta-section {
      padding: 80px 20px;
      background: linear-gradient(135deg, #0056D2, #0077FF);
      color: white;
      border-radius: 30px;
      position: relative;
      overflow: hidden;
      text-align: center;
    }
    .blob-bg {
      position: absolute;
      top: -50px;
      right: -50px;
      width: 300px;
      height: 300px;
      background: rgba(255,255,255,0.2);
      border-radius: 50%;
      filter: blur(50px);
      z-index: 0;
    }
    .footer {
      text-align: center;
      padding: 20px 0;
      font-size: 14px;
      color: #6c757d;
    }
  </style>
</head>

<body>
  @include('external.home_nav')

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h1>Find What You Need, Learn What You Love</h1>
          <p>Discover, Share & Learn — Your Gateway to the Ultimate Educational Resource Hub with Q&A, Open Library & AI Assistance.</p>
          <a href="{{ url('/search') }}">
            <button class="hero-btn fw-bold">Explore Resources</button>
          </a>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
          <img src="https://i.postimg.cc/Wp9nzt2H/hero-sidebar.png" alt="Learning" class="hero-img">
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center fw-bold mb-5">What Makes enLearners Special?</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="feature-box">
            <div class="feature-icon">🔍</div>
            <h5 class="fw-bold">Discover Resources</h5>
            <p>Search and explore a massive library of educational content tailored to your needs.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-box">
            <div class="feature-icon">💾</div>
            <h5 class="fw-bold">Save & Organize</h5>
            <p>Keep track of your favorite resources and access them from your personalized dashboard.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-box">
            <div class="feature-icon">🤝</div>
            <h5 class="fw-bold">Contribute Knowledge</h5>
            <p>Share your own study materials and help others grow in their learning journey.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-box">
            <div class="feature-icon">❓</div>
            <h5 class="fw-bold">Q&A Community</h5>
            <p>Engage in topic-based discussions, ask questions, and share expert answers with peers.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-box">
            <div class="feature-icon">📖</div>
            <h5 class="fw-bold">Open Library</h5>
            <p>Access millions of books and references through seamless Open Library integration.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-box">
            <div class="feature-icon">֎🇦🇮</div>
            <h5 class="fw-bold">AI-Powered Help</h5>
            <p>Instant answers to your queries powered by intelligent AI models.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Advertisement Banner -->
  <section class="container my-5">
    <div class="text-center">
      <a href="/" target="_blank">
        <img src="https://i.postimg.cc/mkqCwzkZ/advertisement.png" alt="Advertisement" class="img-fluid rounded-3 shadow-sm">
      </a>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="cta-section container mt-5">
    <div class="blob-bg"></div>
    <div class="cta-content">
      <h2 class="fw-bold">Ready to Join the Largest Educational Resource Hub?</h2>
      <p class="lead">Start learning, contributing, and growing with enLearners today.</p>
      <a href="{{ url('/signup') }}">
        <button class="hero-btn fw-bold">Start Learning</button>
      </a>
    </div>
  </section>
  
  <div>
    <br>
    <br>
  </div>
  @include('external.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
