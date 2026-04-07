<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Add New Doctor</h4>
    <a href="<?= base_url('admin/doctors') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="table-container">
    <form action="<?= base_url('admin/doctors/store') ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Specialization <span class="text-danger">*</span></label>
                <input type="text" name="specialization" class="form-control" value="<?= old('specialization') ?>" placeholder="e.g., Cardiology, Orthopedics" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Experience</label>
                <input type="text" name="experience" class="form-control" value="<?= old('experience') ?>" placeholder="e.g., 10 Years">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Qualification</label>
                <input type="text" name="qualification" class="form-control" value="<?= old('qualification') ?>" placeholder="e.g., MBBS, MD, MS">
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Availability Time</label>
            <input type="text" name="availability_time" class="form-control" value="<?= old('availability_time') ?>" placeholder="e.g., Mon-Sat: 9:00 AM - 6:00 PM">
        </div>
        
        <div class="text-end">
            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-primary-custom">Save Doctor</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
