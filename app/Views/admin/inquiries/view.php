<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>View Inquiry</h4>
    <a href="<?= base_url('admin/inquiries') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="table-container mb-4">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h5><?= esc($inquiry['subject']) ?></h5>
                    <small class="text-muted">From: <?= esc($inquiry['name']) ?> (<?= esc($inquiry['email']) ?>)</small>
                </div>
                <span class="badge bg-<?= 
                    $inquiry['status'] == 'New' ? 'danger' : 
                    ($inquiry['status'] == 'Read' ? 'warning' : 'success') 
                ?> fs-6">
                    <?= $inquiry['status'] ?>
                </span>
            </div>
            
            <hr>
            
            <div class="mb-4">
                <h6 class="text-muted mb-2">Message:</h6>
                <div class="p-3 bg-light rounded">
                    <?= nl2br(esc($inquiry['message'])) ?>
                </div>
            </div>
            
            <div class="row text-muted small">
                <div class="col-md-6">
                    <strong>Phone:</strong> <?= esc($inquiry['phone']) ?>
                </div>
                <div class="col-md-6 text-md-end">
                    <strong>Received:</strong> <?= date('d M Y H:i A', strtotime($inquiry['created_at'])) ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="table-container">
            <h6 class="mb-3">Update Status</h6>
            <form action="<?= base_url('admin/inquiries/update-status/' . $inquiry['id']) ?>" method="POST">
                <?= csrf_field() ?>
                <select name="status" class="form-select mb-3" onchange="this.form.submit()">
                    <option value="New" <?= $inquiry['status'] == 'New' ? 'selected' : '' ?>>New</option>
                    <option value="Read" <?= $inquiry['status'] == 'Read' ? 'selected' : '' ?>>Read</option>
                    <option value="Replied" <?= $inquiry['status'] == 'Replied' ? 'selected' : '' ?>>Replied</option>
                </select>
            </form>
            
            <hr>
            
            <h6 class="mb-3">Contact Information</h6>
            <p class="mb-2"><i class="bi bi-person me-2"></i><?= esc($inquiry['name']) ?></p>
            <p class="mb-2"><i class="bi bi-envelope me-2"></i><?= esc($inquiry['email']) ?></p>
            <p class="mb-2"><i class="bi bi-telephone me-2"></i><?= esc($inquiry['phone']) ?></p>
            
            <hr>
            
            <a href="mailto:<?= $inquiry['email'] ?>?subject=Re: <?= $inquiry['subject'] ?>" class="btn btn-primary-custom w-100">
                <i class="bi bi-reply me-2"></i>Reply via Email
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
