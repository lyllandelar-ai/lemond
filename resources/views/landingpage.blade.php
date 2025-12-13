<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrackIt - Delivery & Shipping Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #dc2626;
            --dark-red: #991b1b;
            --light-red: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-red) !important;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 1rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-red) !important;
        }

        .btn-primary {
            background: var(--primary-red);
            border: none;
            padding: 0.7rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--dark-red);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
        }

        .btn-outline-danger {
            color: var(--primary-red);
            border: 2px solid var(--primary-red);
            padding: 0.7rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            background: transparent;
        }

        .btn-outline-danger:hover {
            background: var(--primary-red);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            border: none;
            margin-top: 10px;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .dropdown-item:hover {
            background: #fee2e2;
            color: var(--primary-red);
        }

        .hero-section {
            background: linear-gradient(135deg, #fef2f2 0%, #fff1f2 50%, white 100%);
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, 30px) scale(1.1); }
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #991b1b 0%, #dc2626 50%, #ef4444 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }

        .tracking-input-group {
            max-width: 600px;
            margin: 2rem auto;
        }

        .tracking-input {
            border: 2px solid rgba(220, 38, 38, 0.1);
            border-radius: 50px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(220, 38, 38, 0.1);
            transition: all 0.3s ease;
        }

        .tracking-input:hover {
            border-color: rgba(220, 38, 38, 0.3);
            box-shadow: 0 12px 40px rgba(220, 38, 38, 0.15);
        }

        .tracking-input:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.2rem rgba(220, 38, 38, 0.1);
        }

        .btn-track {
            border-radius: 50px;
            padding: 1rem 2.5rem;
            font-weight: 600;
        }

        .features-section {
            padding: 80px 0;
            background: white;
        }

        .feature-card {
            padding: 2rem;
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
            height: 100%;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            padding: 2px;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            transition: all 0.4s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(220, 38, 38, 0.15);
        }

        .feature-card:hover::before {
            background: linear-gradient(135deg, #dc2626, #ef4444);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
            color: var(--primary-red);
            border: none;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            transition: all 0.3s;
        }

        .feature-card:hover .feature-icon {
            background: linear-gradient(135deg, var(--primary-red) 0%, #ef4444 100%);
            color: white;
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.3);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .stats-section {
            background: linear-gradient(135deg, #991b1b 0%, #dc2626 50%, #b91c1c 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .stats-section .container {
            position: relative;
            z-index: 1;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            animation: countUp 0.8s ease-out;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .footer {
            background: #1f2937;
            color: white;
            padding: 40px 0 20px;
        }

        .footer a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: var(--primary-red);
        }

        .modal-content {
            border-radius: 20px;
            border: none;
        }

        .modal-header {
            border-bottom: none;
            padding: 2rem 2rem 1rem;
        }

        .modal-body {
            padding: 1rem 2rem 2rem;
        }

        .form-control:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 0.2rem rgba(220, 38, 38, 0.1);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-shipping-fast"></i> TrackIt</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact" style="cursor: pointer;">Contact</a></li>
                    <li class="nav-item"><button class="btn btn-outline-danger ms-3" id="loginBtn">Log In</button></li>
                    <li class="nav-item"><button class="btn btn-primary ms-2" id="navTrackBtn">Track Now</button></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="track">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <h1 class="hero-title">Track Your Deliveries in Real-Time</h1>
                    <p class="hero-subtitle">Monitor all your shipments from multiple carriers in one place</p>
                    
                    <div class="tracking-input-group">
                        <div class="input-group">
                            <input type="text" class="form-control tracking-input" placeholder="Enter your tracking number">
                            <button class="btn btn-primary btn-track" type="button">
                                <i class="fas fa-search me-2"></i>Track Package
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="stat-number">1M+</div>
                    <div class="stat-label">Packages Tracked</div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Shipping Carriers</div>
                </div>
                <div class="col-md-4">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Accuracy Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section" id="how-it-works" style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">How It Works</h2>
                <p class="text-muted fs-5">Track your packages in three simple steps</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="step-icon mb-4" style="width: 80px; height: 80px; background: var(--primary-red); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 800; margin: 0 auto;">
                            1
                        </div>
                        <h4 class="fw-bold mb-3">Enter Tracking Number</h4>
                        <p class="text-muted">Simply paste or type your tracking number from any carrier into our search box</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="step-icon mb-4" style="width: 80px; height: 80px; background: var(--primary-red); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 800; margin: 0 auto;">
                            2
                        </div>
                        <h4 class="fw-bold mb-3">Get Real-Time Updates</h4>
                        <p class="text-muted">Watch as your package moves through the shipping network with live status updates</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="step-icon mb-4" style="width: 80px; height: 80px; background: var(--primary-red); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 800; margin: 0 auto;">
                            3
                        </div>
                        <h4 class="fw-bold mb-3">Receive Notifications</h4>
                        <p class="text-muted">Get notified via email or SMS when your package is out for delivery or delivered</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <button class="btn btn-primary btn-lg" style="padding: 1rem 3rem; border-radius: 50px; font-weight: 600;">
                    <i class="fas fa-play me-2"></i>Try It Now
                </button>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Why Choose TrackIt?</h2>
                <p class="text-muted fs-5">Everything you need to manage your deliveries</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="feature-title">Real-Time Updates</h3>
                        <p class="text-muted">Get instant notifications on every status change of your package</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="feature-title">Multi-Carrier Support</h3>
                        <p class="text-muted">Track packages from all major shipping carriers worldwide</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="feature-title">Mobile Friendly</h3>
                        <p class="text-muted">Access your tracking information anywhere, anytime on any device</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="feature-title">Smart Notifications</h3>
                        <p class="text-muted">Receive alerts via email, SMS, or push notifications</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3 class="feature-title">Map Tracking</h3>
                        <p class="text-muted">Visualize your package journey on an interactive map</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 class="feature-title">Secure & Private</h3>
                        <p class="text-muted">Your tracking data is encrypted and completely secure</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" style="padding: 80px 0; background: linear-gradient(135deg, #f8f9fa 0%, white 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Get In Touch</h2>
                <p class="text-muted fs-5">Have questions? We'd love to hear from you</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <div style="width: 60px; height: 60px; background: var(--primary-red); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto;">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold mb-3">Email Us</h5>
                                    <a href="mailto:support@trackit.com" class="text-decoration-none" style="color: var(--primary-red); font-weight: 500;">support@trackit.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <div style="width: 60px; height: 60px; background: var(--primary-red); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto;">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold mb-3">Call Us</h5>
                                    <a href="tel:+15551234567" class="text-decoration-none" style="color: var(--primary-red); font-weight: 500;">+1 (555) 123-4567</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <form id="contactForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Your Name" required style="border-radius: 10px; padding: 12px;">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" placeholder="Your Email" required style="border-radius: 10px; padding: 12px;">
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" placeholder="Subject" required style="border-radius: 10px; padding: 12px;">
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" rows="5" placeholder="Your Message" required style="border-radius: 10px; padding: 12px;"></textarea>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary" style="padding: 12px 40px; border-radius: 50px; font-weight: 600;">
                                            <i class="fas fa-paper-plane me-2"></i>Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="loginModalLabel">
                        <i class="fas fa-shipping-fast text-danger me-2"></i>Log In to TrackIt
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form id="loginForm" method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="loginEmail" name="email" value="{{ old('email') }}" placeholder="Enter your email" required style="border-radius: 10px; padding: 12px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="loginPassword" name="password" placeholder="Enter your password" required style="border-radius: 10px; padding: 12px;">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary" style="padding: 12px; border-radius: 10px; font-weight: 600;">
                                <i class="fas fa-sign-in-alt me-2"></i>Log In
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="#" class="text-decoration-none" style="color: var(--primary-red);">Forgot password?</a>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-2">Don't have an account?</p>
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal" style="border-radius: 10px; padding: 10px 30px;">
                                <i class="fas fa-user-plus me-2"></i>Sign Up
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="registerModalLabel">
                        <i class="fas fa-shipping-fast text-danger me-2"></i>Create Your TrackIt Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="registerName" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" id="registerName" name="name" placeholder="Enter your full name" required style="border-radius: 10px; padding: 12px;">
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Enter your email" required style="border-radius: 10px; padding: 12px;">
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Create a password (min. 8 characters)" required style="border-radius: 10px; padding: 12px;">
                        </div>
                        <div class="mb-3">
                            <label for="registerPasswordConfirm" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" class="form-control" id="registerPasswordConfirm" name="password_confirmation" placeholder="Confirm your password" required style="border-radius: 10px; padding: 12px;">
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary" style="padding: 12px; border-radius: 10px; font-weight: 600;">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-2">Already have an account?</p>
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal" style="border-radius: 10px; padding: 10px 30px;">
                                <i class="fas fa-sign-in-alt me-2"></i>Log In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3"><i class="fas fa-shipping-fast"></i> TrackIt</h5>
                    <p class="text-white">Your reliable delivery tracking solution for all your shipping needs.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#features">Features</a></li>
                        <li class="mb-2"><a href="#how-it-works">How It Works</a></li>
                        <li class="mb-2"><a href="#contact">Contact</a></li>
                        <li class="mb-2"><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Connect With Us</h5>
                    <p class="text-white"><i class="fas fa-envelope me-2"></i> <a href="mailto:support@trackit.com" class="text-white text-decoration-none">support@trackit.com</a></p>
                    <p class="text-white"><i class="fas fa-phone me-2"></i> <a href="tel:+15551234567" class="text-white text-decoration-none">+1 (555) 123-4567</a></p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3" aria-label="Facebook"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white me-3" aria-label="Twitter"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white me-3" aria-label="Instagram"><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: #374151;">
            <div class="text-center text-white">
                <p>&copy; 2025 TrackIt. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Try It Now button functionality
        document.querySelector('.btn-primary[onclick]') || document.addEventListener('DOMContentLoaded', function() {
            const tryNowBtn = document.querySelector('.how-it-works-section .btn-primary');
            if (tryNowBtn) {
                tryNowBtn.addEventListener('click', function() {
                    // Scroll to the tracking section
                    document.querySelector('#track').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Focus on the tracking input
                    setTimeout(() => {
                        document.querySelector('.tracking-input').focus();
                    }, 500);
                });
            }
        });

        // Track Package button functionality
        document.querySelector('.btn-track').addEventListener('click', function() {
            const trackingNumber = document.querySelector('.tracking-input').value.trim();
            if (trackingNumber) {
                // Show loading state
                const button = this;
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Tracking...';
                button.disabled = true;
                
                // Simulate tracking API call
                setTimeout(() => {
                    // Reset button
                    button.innerHTML = originalText;
                    button.disabled = false;
                    
                    // Show tracking results (placeholder)
                    showTrackingResults(trackingNumber);
                }, 2000);
            } else {
                // Add visual feedback for empty input
                const input = document.querySelector('.tracking-input');
                input.style.borderColor = 'var(--primary-red)';
                input.placeholder = 'Please enter a tracking number';
                input.focus();
                
                // Reset after 3 seconds
                setTimeout(() => {
                    input.style.borderColor = '';
                    input.placeholder = 'Enter your tracking number';
                }, 3000);
            }
        });

        // Allow Enter key to trigger tracking
        document.querySelector('.tracking-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.querySelector('.btn-track').click();
            }
        });

        // Navigation Track Now button functionality
        document.querySelector('#navTrackBtn').addEventListener('click', function() {
            // Scroll to tracking section
            document.querySelector('#track').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            // Focus on input after scroll
            setTimeout(() => {
                document.querySelector('.tracking-input').focus();
            }, 500);
        });

        // Login button functionality - Open modal
        document.querySelector('#loginBtn').addEventListener('click', function() {
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });

        // Function to show tracking results
        function showTrackingResults(trackingNumber) {
            // Create or update results section
            let resultsSection = document.querySelector('#trackingResults');
            if (!resultsSection) {
                resultsSection = document.createElement('div');
                resultsSection.id = 'trackingResults';
                resultsSection.className = 'mt-5';
                document.querySelector('#track .container').appendChild(resultsSection);
            }
            
            // Sample tracking data (in real app, this would come from API)
            const trackingData = {
                number: trackingNumber,
                status: 'In Transit',
                location: 'New York, NY',
                estimatedDelivery: 'December 2, 2025',
                carrier: 'FedEx',
                updates: [
                    { date: '2025-11-30 10:30 AM', status: 'Package picked up', location: 'Los Angeles, CA' },
                    { date: '2025-11-30 2:15 PM', status: 'Departed facility', location: 'Los Angeles, CA' },
                    { date: '2025-11-30 8:45 PM', status: 'In transit', location: 'Phoenix, AZ' },
                    { date: '2025-12-01 6:20 AM', status: 'Arrived at facility', location: 'New York, NY' }
                ]
            };
            
            resultsSection.innerHTML = `
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-box me-2"></i>Tracking Results</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6><strong>Tracking Number:</strong> ${trackingData.number}</h6>
                                <h6><strong>Status:</strong> <span class="badge bg-success">${trackingData.status}</span></h6>
                                <h6><strong>Current Location:</strong> ${trackingData.location}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Carrier:</strong> ${trackingData.carrier}</h6>
                                <h6><strong>Estimated Delivery:</strong> ${trackingData.estimatedDelivery}</h6>
                            </div>
                        </div>
                        
                        <h6><strong>Tracking History:</strong></h6>
                        <div class="timeline">
                            ${trackingData.updates.map(update => `
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">${update.status}</h6>
                                        <p class="text-muted mb-0">${update.date} - ${update.location}</p>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                        
                        <div class="mt-4 text-center">
                            <button class="btn btn-outline-primary me-2" onclick="trackAnother()">Track Another Package</button>
                            <button class="btn btn-primary" onclick="window.print()">Print Results</button>
                        </div>
                    </div>
                </div>
            `;
            
            // Scroll to results
            resultsSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
        
        // Function to track another package
        function trackAnother() {
            document.querySelector('.tracking-input').value = '';
            document.querySelector('.tracking-input').focus();
            const results = document.querySelector('#trackingResults');
            if (results) {
                results.remove();
            }
        }
        
        // Contact form submission
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show success message
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Message Sent!';
                submitBtn.disabled = true;
                submitBtn.classList.remove('btn-primary');
                submitBtn.classList.add('btn-success');
                
                // Reset form after 2 seconds
                setTimeout(() => {
                    this.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('btn-success');
                    submitBtn.classList.add('btn-primary');
                }, 2000);
            });
        }
    </script>
    
    @if ($errors->any() || session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });
    </script>
    @endif
</body>
</html>