<?php helper('text'); ?>
<?= $this->extend('public/layout/main') ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="hero-title">Your Health is<br>Our Priority</h1>
                <p class="hero-subtitle">At Mithlesh Nursing Home, we provide comprehensive healthcare services with state-of-the-art facilities and a team of compassionate medical professionals dedicated to your wellness.</p>
                <div>
                    <a href="<?= base_url('contact') ?>" class="btn btn-lg px-5 py-3 rounded-pill fw-bold me-3" style="margin-bottom: 10px; background: #7C3AED; color: white;">
                        <i class="bi bi-calendar-check me-2"></i>Book Appointment
                    </a>
                    <a href="<?= base_url('services') ?>" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold" style="margin-bottom: 10px;">
                        <i class="bi bi-stethoscope me-2"></i>Our Services
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center d-none d-lg-block">
                <i class="bi bi-heart-pulse" style="font-size: 200px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Intro Section -->
<section class="spacer-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 style="font-size: 32px; font-weight: 800; color: #1E1B4B; margin-bottom: 20px;">Patient-Centered Healthcare Excellence</h3>
                <p style="font-size: 17px; color: #666; line-height: 1.8; margin-bottom: 20px;">At Mithlesh Nursing Home, we combine cutting-edge medical technology with compassionate patient care. Our commitment is to provide every patient with personalized healthcare solutions that exceed expectations.</p>
                <div style="display: flex; gap: 30px; margin-bottom: 40px;">
                    <div>
                        <h5 style="color: var(--primary-color); font-weight: 700;">Quality First</h5>
                        <p style="color: #666; font-size: 14px;">ISO Certified Facilities</p>
                    </div>
                    <div>
                        <h5 style="color: var(--primary-color); font-weight: 700;">Always Available</h5>
                        <p style="color: #666; font-size: 14px;">24/7 Emergency Services</p>
                    </div>
                    <div>
                        <h5 style="color: var(--primary-color); font-weight: 700;">Expert Team</h5>
                        <p style="color: #666; font-size: 14px;">Highly Qualified Doctors</p>
                    </div>
                </div>
                <div style="padding: 30px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 20px;">
                    <h4 style="color: white; font-weight: 700; margin-bottom: 8px; font-size: 24px;">Trusted by Thousands</h4>
                    <p style="color: rgba(255,255,255,0.95); margin: 0; font-size: 16px;">Serving the community with excellence for over 25 years</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div style="background: white; border-radius: 25px; overflow: hidden; box-shadow: 0 15px 50px rgba(124, 58, 237, 0.15); position: relative; transition: all 0.3s ease;">
                    <div style="background: linear-gradient(135deg, rgba(76, 29, 149, 0.6) 0%, rgba(124, 58, 237, 0.5) 100%); padding: 20px; position: relative; overflow: hidden; min-height: 400px; display: flex; align-items: center; justify-content: center;">
                        <img src="<?= base_url('images/Mithlesh_front.webp') ?>" alt="Mithlesh Nursing Home" style="max-width: 100%; max-height: 100%; object-fit: contain; position: relative; z-index: 2;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Medical Services</h2>
            <p class="text-muted">Comprehensive healthcare solutions tailored to your needs</p>
        </div>
        <div class="row g-4">
            <?php if (!empty($services)): ?>
                <?php foreach (array_slice($services, 0, 6) as $service): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="<?= $service['icon'] ?? 'bi bi-heart-pulse' ?>"></i>
                            </div>
                            <h4><?= esc($service['title']) ?></h4>
                            <p class="text-muted"><?= character_limiter($service['description'], 100) ?></p>
                            <a href="<?= base_url('services') ?>" class="btn btn-outline-primary rounded-pill fw-bold">
                                <i class="bi bi-arrow-right me-1"></i>Learn More
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= base_url('services') ?>" class="btn btn-lg px-5 rounded-pill fw-bold" style="background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border: none; color: white;">
                <i class="bi bi-hospital me-2"></i>Explore All Services
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="stat-item">
                    <div class="stat-icon"><i class="bi bi-people"></i></div>
                    <div class="stat-number">10,000+</div>
                    <div class="stat-label">Patients Treated</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-item">
                    <div class="stat-icon"><i class="bi bi-person-badge"></i></div>
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Expert Doctors</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-item">
                    <div class="stat-icon"><i class="bi bi-award"></i></div>
                    <div class="stat-number">25+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stat-item">
                    <div class="stat-icon"><i class="bi bi-shield-check"></i></div>
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Emergency Care</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Doctors Section -->
<section class="doctors-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Expert Medical Team</h2>
            <p class="text-muted">Highly qualified doctors with years of experience in their respective fields</p>
        </div>
        <div class="row g-4">
            <?php if (!empty($doctors)): ?>
                <?php foreach (array_slice($doctors, 0, 4) as $doctor): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="doctor-card">
                            <div class="doctor-img">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="doctor-info">
                                <h5><?= esc($doctor['name']) ?></h5>
                                <p class="text-primary fw-bold mb-2"><?= esc($doctor['specialization']) ?></p>
                                <p class="text-muted small mb-2"><i class="bi bi-book me-1"></i><?= $doctor['experience'] ?? '0' ?> Years Experience</p>
                                <p class="text-muted small mb-3"><i class="bi bi-clock me-1"></i><?= $doctor['availability_time'] ?: 'Mon-Sat: 9AM-6PM' ?></p>
                                <a href="<?= base_url('doctors') ?>" class="btn btn-sm btn-outline-primary rounded-pill">View Profile</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= base_url('doctors') ?>" class="btn btn-outline-primary btn-lg px-5 rounded-pill fw-bold">
                <i class="bi bi-people-fill me-2"></i>View All Doctors
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section style="background: white; padding: 100px 0; position: relative;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 style="font-weight: 800; font-size: 42px; color: #1E1B4B; margin-bottom: 30px; line-height: 1.2;">Why Choose<br><span style="color: var(--primary-color);">Mithlesh Nursing Home?</span></h2>
                <div style="display: flex; align-items: flex-start; gap: 20px; margin-bottom: 25px;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-shield-check text-white fs-4"></i>
                    </div>
                    <div>
                        <h5 style="font-weight: 700; color: #1E1B4B; margin-bottom: 8px;">Quality Healthcare</h5>
                        <p style="color: #666; margin: 0;">We maintain the highest standards with ISO certification and modern equipment for optimal patient care.</p>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 20px; margin-bottom: 25px;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-people text-white fs-4"></i>
                    </div>
                    <div>
                        <h5 style="font-weight: 700; color: #1E1B4B; margin-bottom: 8px;">Expert Team</h5>
                        <p style="color: #666; margin: 0;">Our team of highly qualified and experienced doctors stays updated with latest medical practice advancements.</p>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 20px; margin-bottom: 25px;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-heart-pulse text-white fs-4"></i>
                    </div>
                    <div>
                        <h5 style="font-weight: 700; color: #1E1B4B; margin-bottom: 8px;">Patient Care</h5>
                        <p style="color: #666; margin: 0;">Individual attention and personalized treatment plans tailored to each patient's unique requirements.</p>
                    </div>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 20px;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-clock-history text-white fs-4"></i>
                    </div>
                    <div>
                        <h5 style="font-weight: 700; color: #1E1B4B; margin-bottom: 8px;">24/7 Emergency</h5>
                        <p style="color: #666; margin: 0;">Round-the-clock emergency services with fully equipped ICU and trauma care facilities.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div style="background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 20px; padding: 60px 40px; color: white; box-shadow: 0 20px 60px rgba(124, 58, 237, 0.2);">
                    <h3 class="fw-bold mb-3" style="font-size: 28px;">Need Immediate Assistance?</h3>
                    <p class="mb-4" style="font-size: 16px; opacity: 0.95;">Our emergency department is operational 24/7 to provide immediate medical intervention and support.</p>
                    <div style="background: rgba(255,255,255,0.2); border-radius: 15px; padding: 25px; margin-bottom: 25px;">
                        <p style="font-size: 14px; opacity: 0.9; margin-bottom: 10px;">Emergency Hotline</p>
                        <h2 class="fw-bold" style="font-size: 36px; margin: 0;"><i class="bi bi-telephone me-2"></i>+07662-355315</h2>
                    </div>
                    <a href="<?= base_url('contact') ?>" class="btn btn-light btn-lg fw-bold" style="border-radius: 15px;">
                        <i class="bi bi-arrow-right me-2"></i>Contact Us Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
