<?= $this->extend('public/layout/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); padding: 80px 0; color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
        <p class="lead">Get in touch with us for appointments and inquiries</p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Info -->
            <div class="col-lg-5">
                <h3 class="fw-bold mb-4">Contact Information</h3>
                <p class="text-muted mb-4">Feel free to reach out to us for any medical assistance or inquiries. Our team is available 24/7 to help you.</p>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-geo-alt text-white fs-5"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Address</h5>
                        <p class="text-muted mb-0">Behind Pawar Gas Godown,Urrhat, Allahabad Road,Rewa <br>State - M.P., India</p>
                    </div>
                </div>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-telephone text-white fs-5"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Phone</h5>
                        <p class="text-muted mb-0">Emergency: +91 9770921099, 7024745594 <br>Reception: + 07662-355315</p>
                    </div>
                </div>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-envelope text-white fs-5"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Email</h5>
                        <p class="text-muted mb-0">info@Mithleshnursing.com<br>Mithleshnursinghome@gmail.com</p>
                    </div>
                </div>
                
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-clock text-white fs-5"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Working Hours</h5>
                        <p class="text-muted mb-0">OPD: 9:00 AM - 6:00 PM (Mon-Sat)<br>Emergency: 24/7 Available</p>
                    </div>
                </div>
            </div>
            
            <!-- Inquiry Form -->
            <div class="col-lg-7">
                <div class="bg-white p-5 rounded-4 shadow-sm">
                    <h3 class="fw-bold mb-4">Send us a Message</h3>
                    
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('submit-inquiry') ?>" method="POST">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" name="subject" class="form-control" value="<?= old('subject') ?>" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control" rows="5" required><?= old('message') ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, #7C3AED 0%, #A855F7 100%); border: none; color: white;">
                            <i class="bi bi-send me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
