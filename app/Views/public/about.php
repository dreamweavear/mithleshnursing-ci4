<?= $this->extend('public/layout/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); padding: 80px 0; color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">About Us</h1>
        <p class="lead">Learn more about Mithlesh Nursing Home and our commitment to healthcare excellence</p>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?w=800" alt="Hospital" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Welcome to Mithlesh Nursing Home</h2>
                <p class="text-muted mb-4">Mithlesh Nursing Home has been serving the community for over 25 years, providing comprehensive healthcare services with a patient-centered approach. Our state-of-the-art facility is equipped with modern medical technology and staffed by experienced healthcare professionals.</p>
                <p class="text-muted mb-4">We believe in treating every patient with compassion, dignity, and respect. Our mission is to deliver high-quality medical care that improves the health and well-being of our community.</p>
                
                <div class="row g-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill fs-4 me-2" style="color: #7C3AED;"></i>
                            <span>Quality Care</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill fs-4 me-2" style="color: #7C3AED;"></i>
                            <span>Expert Doctors</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill fs-4 me-2" style="color: #7C3AED;"></i>
                            <span>Modern Equipment</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill fs-4 me-2" style="color: #7C3AED;"></i>
                            <span>24/7 Service</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section style="background: #f8f9fa; padding: 80px 0;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="bg-white p-5 rounded-4 shadow-sm h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;" class="me-4">
                            <i class="bi bi-bullseye text-white fs-3"></i>
                        </div>
                        <h3 class="mb-0">Our Mission</h3>
                    </div>
                    <p class="text-muted">To provide accessible, affordable, and high-quality healthcare services to all sections of society. We are committed to continuous improvement in medical care through innovation, education, and compassionate service.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-white p-5 rounded-4 shadow-sm h-100">
                    <div class="d-flex align-items-center mb-4">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;" class="me-4">
                            <i class="bi bi-eye text-white fs-3"></i>
                        </div>
                        <h3 class="mb-0">Our Vision</h3>
                    </div>
                    <p class="text-muted">To become the most trusted healthcare provider in the region, known for excellence in patient care, medical innovation, and community health improvement. We aspire to set new standards in healthcare delivery.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Core Values</h2>
            <p class="text-muted">The principles that guide our healthcare services</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-heart text-white fs-2"></i>
                    </div>
                    <h4>Compassion</h4>
                    <p class="text-muted">We treat every patient with empathy, understanding, and genuine care for their well-being.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-shield-check text-white fs-2"></i>
                    </div>
                    <h4>Integrity</h4>
                    <p class="text-muted">We maintain the highest ethical standards in all our medical practices and patient interactions.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-star text-white fs-2"></i>
                    </div>
                    <h4>Excellence</h4>
                    <p class="text-muted">We continuously strive for excellence in healthcare delivery and patient outcomes.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
