<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Mithlesh Nursing Home') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
  <!-- added fevicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon-16x16.png') ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('apple-touch-icon.png') ?>">
    
    
    
    
    
    
    <style>
        :root {
            --primary-color: #7C3AED;
            --secondary-color: #A855F7;
            --dark-color: #1E1B4B;
            --light-bg: #f8f9fa;
        }
        
        * {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        
        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 12px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }
        
        .navbar-brand i {
            color: var(--primary-color);
            margin-right: 10px;
        }
        
        .nav-link {
            font-weight: 500;
            color: #333 !important;
            margin: 0 10px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after,
        .nav-link.active:after {
            width: 100%;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
        }
        
        .btn-appointment {
            background: #7C3AED;
            color: white !important;
            border-radius: 25px;
            padding: 10px 25px !important;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
        }

        .btn-appointment:hover {
            background: #6D28D9;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(76, 29, 149, 0.95) 0%, rgba(124, 58, 237, 0.85) 50%, rgba(168, 85, 247, 0.75) 100%),
                        url('images/mithlesh-front.webp');
            background-size: cover;
            background-position: center;
            padding: 140px 0 100px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(168, 85, 247, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .hero-section .container {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: 54px;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .hero-subtitle {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.95;
            line-height: 1.6;
        }
        
        .hero-section .btn {
            transition: all 0.3s ease;
            font-weight: 600;
            border-radius: 30px;
            padding: 12px 35px !important;
        }
        
        .hero-section .btn:hover {
            transform: translateY(-2px);
        }
        
        /* Section Spacing */
        .spacer-section {
            padding: 40px 0;
            background: white;
        }
        
        /* Services Section */
        .services-section {
            padding: 100px 0;
            background: white;
            position: relative;
        }
        
        .services-section:before {
            content: '';
            position: absolute;
            top: -50px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: rgba(124, 58, 237, 0.05);
            border-radius: 50%;
            pointer-events: none;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
            z-index: 1;
        }
        
        .section-title h2 {
            font-weight: 800;
            color: #1E1B4B;
            margin-bottom: 15px;
            font-size: 42px;
            letter-spacing: -1px;
        }
        
        .section-title p {
            font-size: 18px;
            color: #666;
            font-weight: 500;
        }
        
        .service-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-top: 4px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .service-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.05) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        
        .service-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 15px 50px rgba(124, 58, 237, 0.2);
            border-top-color: var(--primary-color);
        }
        
        .service-card:hover:before {
            opacity: 1;
        }
        
        .service-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 40px;
            color: white;
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.3);
            transition: all 0.3s ease;
        }
        
        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(-5deg);
        }
        
        .service-card h4 {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 12px;
            color: #1E1B4B;
        }
        
        .service-card p {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .service-card .btn {
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        /* Doctors Section */
        .doctors-section {
            padding: 100px 0;
            background: var(--light-bg);
            position: relative;
        }
        
        .doctors-section:after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -100px;
            width: 400px;
            height: 400px;
            background: rgba(168, 85, 247, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }
        
        .doctor-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            position: relative;
        }
        
        .doctor-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 50px rgba(124, 58, 237, 0.2);
        }
        
        .doctor-img {
            height: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 100px;
            color: rgba(255, 255, 255, 0.8);
            position: relative;
            overflow: hidden;
        }
        
        .doctor-img:before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }
        
        .doctor-info {
            padding: 30px;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .doctor-info h5 {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 8px;
            color: #1E1B4B;
        }
        
        .doctor-info .text-primary {
            font-weight: 700 !important;
            color: var(--primary-color) !important;
            font-size: 15px;
        }
        
        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 80px 0 30px;
            position: relative;
        }
        
        .footer h5 {
            margin-bottom: 20px;
            color: var(--secondary-color);
            font-weight: 700;
            font-size: 18px;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .footer-links a:hover {
            color: var(--secondary-color);
            margin-left: 5px;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 50px;
            padding-top: 30px;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 500;
        }

        .nav-link.admin-link {
            font-weight: 600;
            color: #0d6efd !important;
        }
        
        /* Stats Section Improvements */
        .stats-section {
            background: linear-gradient(135deg, var(--dark-color) 0%, #2D1B69 100%);
            padding: 80px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .stats-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(168, 85, 247, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(124, 58, 237, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .stat-item {
            text-align: center;
            position: relative;
            z-index: 1;
            padding: 30px;
            transition: all 0.3s ease;
        }
        
        .stat-item:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 50px;
            color: var(--secondary-color);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .stat-item:hover .stat-icon {
            transform: scale(1.2);
        }
        
        .stat-number {
            font-size: 42px;
            font-weight: 800;
            margin: 15px 0;
        }
        
        .stat-label {
            font-size: 17px;
            opacity: 0.9;
            font-weight: 600;
        }
        
        /* Button Styles */
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: slideInUp 0.6s ease-out;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 38px;
            }
            
            .section-title h2 {
                font-size: 32px;
            }
            
            .service-card {
                padding: 30px 20px;
            }
            
            .stat-number {
                font-size: 32px;
            }
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="bi bi-hospital"></i>Mithlesh Nursing Home
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '') ? 'active' : '' ?>" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'about') ? 'active' : '' ?>" href="<?= base_url('about') ?>">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'services') ? 'active' : '' ?>" href="<?= base_url('services') ?>">Services</a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'camps') ? 'active' : '' ?>" href="<?= base_url('camps') ?>">Camps</a>
                    </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'doctors') ? 'active' : '' ?>" href="<?= base_url('doctors') ?>">Doctors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'contact') ? 'active' : '' ?>" href="<?= base_url('contact') ?>">Contact</a>
                    </li>
                   
                    <!-- ✅ Admin Panel as normal nav link -->
                    <li class="nav-item">
                        <a class="nav-link admin-link  <?= (uri_string() == 'admin/login') ? 'active' : '' ?>" 
                        href="<?= base_url('admin/login') ?>">
                        Admin Login
                        </a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        <a class="nav-link btn-appointment " href="<?= base_url('contact') ?>">
                            <i class="bi bi-calendar-check me-2"></i>Book Appointment
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Spacer for fixed navbar -->
    <div style="height: 76px;"></div>
    
    <!-- Main Content -->
    <?= $this->renderSection('content') ?>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="bi bi-hospital me-2"></i>Mithlesh Nursing Home</h5>
                    <p>Providing quality healthcare services with compassion and excellence. Your health is our priority.</p>
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin fs-4"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <div class="footer-links">
                        <a href="<?= base_url('/') ?>">Home</a>
                        <a href="<?= base_url('about') ?>">About Us</a>
                        <a href="<?= base_url('services') ?>">Services</a>
                        <a href="<?= base_url('doctors') ?>">Doctors</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Our Services</h5>
                    <div class="footer-links">
                        <a href="<?= base_url('services') ?>">General Medicine</a>
                        <a href="<?= base_url('services') ?>">Emergency Care</a>
                        <a href="<?= base_url('services') ?>">Laboratory</a>
                        <a href="<?= base_url('services') ?>">Pharmacy</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="bi bi-geo-alt me-2"></i>Behind Pawar Gas Godown,Urrht, Allahabad Road,Rewa,(M.P.)</p>
                    <p><i class="bi bi-telephone me-2"></i>+91 9770921099,7024745594 07662-355315</p>
                    <p><i class="bi bi-envelope me-2"></i>Mithleshnursinghome@gmail.com</p>
                    <p><i class="bi bi-clock me-2"></i>24/7 Emergency Available</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">&copy; <?= date('Y') ?> Mithlesh Nursing Home. All rights reserved. | Powered by  <a href="https://aruncomputer.com/">Arun Computer</a>  |   </p>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
