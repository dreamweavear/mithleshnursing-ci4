<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Doctor</h4>
    <a href="<?= base_url('admin/doctors') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="table-container">
    <form action="<?= base_url('admin/doctors/update/' . $doctor['id']) ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= esc($doctor['name']) ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Specialization <span class="text-danger">*</span></label>
                <input type="text" name="specialization" class="form-control" value="<?= esc($doctor['specialization']) ?>" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" value="<?= esc($doctor['phone']) ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= esc($doctor['email']) ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Experience</label>
                <input type="text" name="experience" class="form-control" value="<?= esc($doctor['experience']) ?>">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Qualification</label>
                <input type="text" name="qualification" class="form-control" value="<?= esc($doctor['qualification']) ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Availability Time</label>
                <input type="text" name="availability_time" class="form-control" value="<?= esc($doctor['availability_time']) ?>">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" <?= $doctor['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $doctor['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>
        
        <div class="text-end">
            <a href="<?= base_url('admin/doctors') ?>" class="btn btn-outline-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary-custom">Update Doctor</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
