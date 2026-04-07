<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Staff</h4>
    <a href="<?= base_url('admin/staff') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="table-container">
    <form action="<?= base_url('admin/staff/update/' . $staff['id']) ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= esc($staff['name']) ?>" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-select" required>
                    <option value="Doctor" <?= $staff['role'] == 'Doctor' ? 'selected' : '' ?>>Doctor</option>
                    <option value="Nurse" <?= $staff['role'] == 'Nurse' ? 'selected' : '' ?>>Nurse</option>
                    <option value="Receptionist" <?= $staff['role'] == 'Receptionist' ? 'selected' : '' ?>>Receptionist</option>
                    <option value="Lab Technician" <?= $staff['role'] == 'Lab Technician' ? 'selected' : '' ?>>Lab Technician</option>
                    <option value="Pharmacist" <?= $staff['role'] == 'Pharmacist' ? 'selected' : '' ?>>Pharmacist</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= esc($staff['email']) ?>">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" value="<?= esc($staff['phone']) ?>" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="3"><?= esc($staff['address']) ?></textarea>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Salary <span class="text-danger">*</span></label>
                <input type="number" name="salary" class="form-control" value="<?= $staff['salary'] ?>" step="0.01" required>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Joining Date <span class="text-danger">*</span></label>
                <input type="date" name="joining_date" class="form-control" value="<?= $staff['joining_date'] ?>" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Qualification</label>
                <input type="text" name="qualification" class="form-control" value="<?= esc($staff['qualification']) ?>">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Active" <?= $staff['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                    <option value="Inactive" <?= $staff['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>
        
        <div class="text-end">
            <a href="<?= base_url('admin/staff') ?>" class="btn btn-outline-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary-custom">Update Staff</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
