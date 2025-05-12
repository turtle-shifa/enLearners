<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
        <h3 class="mb-4 fw-bold text-primary">About Us</h3>
        <h5 class="fw-semibold text-dark">Our Mission</h5>
        <p style="text-align: justify;">At enLearners, we believe that quality education should be accessible, collaborative, and engaging. 
            Our platform empowers students to explore learning resources, contribute valuable materials, and connect with peers 
            for knowledge sharing. With AI-powered query solving, an interactive Q&A hub, and a vast collection of books through 
            Open Library, we aim to create a complete learning ecosystem where students help each other grow.
        </p>
        <h5 class="fw-semibold text-dark">Our Story</h5>
        <p style="text-align: justify;">enLearners started as a university project, driven by the passion to simplify learning and 
            make academic resources more accessible. What began as an idea quickly turned into a collaborative effort involving 
            our team and faculty, aspiring to solve real-world educational challenges.
        </p>
        <h5 class="fw-semibold text-dark">Behind the Scenes</h5>
        <p style="text-align: justify;">Meet the passionate team working tirelessly to bring enLearners to life!
        </p>

        <img src="https://i.postimg.cc/xTpgq8Pd/995ee64e-2b76-4c7d-a2b3-0d66469d75dc.png" 
        alt="enLearners Team" 
        class="img-fluid rounded border" 
        style="max-width: 500px; display: block;">
        <p style="text-align: justify;">From left to right: Mahfuj, Shifa, Radouan.
        </p>

        <div class="container">
            <h5 class="fw-semibold text-dark">Our Supervisors</h5>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <!-- Faculty Card 1 -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold text-dark">Ahmed Akib Jawad Karim</h5>
                            <p class="mb-0"><strong>Email:</strong> ext.akib.jawad@bracu.ac.bd</p>
                        </div>
                    </div>
                </div>

                <!-- Faculty Card 2 -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold text-dark">Nafiz Imtiaz Rafin</h5>
                            <p class="mb-0"><strong>Email:</strong> nafiz.imtiaz@bracu.ac.bd</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h5 class="fw-semibold text-dark">Our Vision</h5>
        <p style="text-align: justify;">To evolve from a university project into a leading platform for learning and resource sharing, 
            fostering a global learning community.
        </p>
        <br>    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
