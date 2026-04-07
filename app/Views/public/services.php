<?= $this->extend('public/layout/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); padding: 80px 0; color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Our Services</h1>
        <p class="lead">Comprehensive healthcare services tailored to your needs</p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s;">
                            <div class="card-body p-4 text-center">
                                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                    <i class="<?= $service['icon'] ?? 'bi bi-heart-pulse' ?> text-white fs-2"></i>
                                </div>
                                <h4 class="card-title"><?= esc($service['title']) ?></h4>
                                <p class="card-text text-muted"><?= esc($service['description']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No services available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section style="background: linear-gradient(135deg, #1E1B4B 0%, #2D1B69 100%); padding: 80px 0; color: white;">
    <div class="container text-center">
        <h2 class="mb-4">Need Medical Assistance?</h2>
        <p class="lead mb-4">Our team of healthcare professionals is ready to help you</p>
        <a href="<?= base_url('contact') ?>" class="btn btn-light btn-lg px-5">Contact Us Now</a>
    </div>
</section>
<?= $this->endSection() ?>
