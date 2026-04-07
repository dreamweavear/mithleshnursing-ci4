<?= $this->extend('public/layout/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #4C1D95 0%, #7C3AED 50%, #A855F7 100%); padding: 80px 0; color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Our Doctors</h1>
        <p class="lead">Meet our team of experienced healthcare professionals</p>
    </div>
</section>

<!-- Doctors Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($doctors)): ?>
                <?php foreach ($doctors as $doctor): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-person-circle" style="font-size: 100px; color: rgba(255,255,255,0.9);"></i>
                            </div>
                            <div class="card-body text-center p-4">
                                <h4 class="card-title"><?= esc($doctor['name']) ?></h4>
                                <p class="text-primary fw-bold"><?= esc($doctor['specialization']) ?></p>
                                <p class="text-muted mb-2"><i class="bi bi-award me-2"></i><?= $doctor['experience'] ?> Experience</p>
                                <p class="text-muted mb-2"><i class="bi bi-mortarboard me-2"></i><?= $doctor['qualification'] ?: 'MBBS, MD' ?></p>
                                <p class="text-muted mb-3"><i class="bi bi-clock me-2"></i><?= $doctor['availability_time'] ?: 'Mon-Sat: 9AM-6PM' ?></p>
                                <a href="<?= base_url('contact') ?>" class="btn" style="background: #7C3AED; color: white;">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No doctors available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
