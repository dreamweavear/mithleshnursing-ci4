<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-person-circle me-2"></i>My Profile</h4>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="table-container">
            <h5 class="mb-1">Account Details</h5>
            <hr>
            <p class="mb-1"><strong>Name:</strong> <?= esc(session()->get('name')) ?></p>
            <p class="mb-0"><strong>Email:</strong> <?= esc(session()->get('email')) ?></p>
        </div>

        <div class="table-container mt-4">
            <h5 class="mb-3">Change Password</h5>
            <hr>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <div><?= esc($err) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/profile/change-password') ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Current Password -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="current_password" id="currentPass" class="form-control" placeholder="Enter current password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-btn" data-target="currentPass">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- New Password -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">New Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="new_password" id="newPass" class="form-control" placeholder="Minimum 6 characters" required>
                        <button type="button" class="btn btn-outline-secondary toggle-btn" data-target="newPass">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm New Password -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Confirm New Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="confirm_password" id="confirmPass" class="form-control" placeholder="Repeat new password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-btn" data-target="confirmPass">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary-custom w-100">
                    <i class="bi bi-shield-lock me-2"></i>Update Password
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.toggle-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var field = document.getElementById(this.dataset.target);
        var icon  = this.querySelector('i');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
});
</script>
<?= $this->endSection() ?>
