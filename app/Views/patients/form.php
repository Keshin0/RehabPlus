<?php $isEdit = $patient !== null;
$pageTitle = ($isEdit ? 'Edit Patient' : 'Add Patient') . ' – RehabPlus'; ?>
<?= view('layouts/header') ?>

<div class="mb-4">
    <a href="<?= site_url('patients') ?>" class="text-muted small text-decoration-none d-inline-flex align-items-center gap-1 mb-1">
        <i class="bi bi-arrow-left"></i>Back to Patients
    </a>
    <p class="page-title mt-1"><?= $isEdit ? 'Edit Patient' : 'Add Patient' ?></p>
</div>

<div class="card shadow-sm" style="max-width:520px">
    <div class="card-body p-4">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger border-0">
                <ul class="mb-0 small"><?php foreach ($errors as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?></ul>
            </div>
        <?php endif; ?>
        <form method="post" action="<?= $isEdit ? site_url('patients/' . $patient['id']) : site_url('patients') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Full Name</label>
                <input type="text" name="name" class="form-control" value="<?= esc($patient['name'] ?? old('name')) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Condition / Diagnosis</label>
                <input type="text" name="condition" class="form-control" value="<?= esc($patient['condition'] ?? old('condition')) ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold small">Profile Photo <span class="text-muted fw-normal">(optional, max 2MB)</span></label>
                <?php if (!empty($patient['avatar'])): ?>
                    <div class="mb-2">
                        <img src="<?= base_url('uploads/avatars/' . $patient['avatar']) ?>" class="rounded-circle" width="56" height="56" style="object-fit:cover;">
                    </div>
                <?php endif ?>
                <input type="file" name="avatar" class="form-control" accept="image/*">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4"><?= $isEdit ? 'Update' : 'Save Patient' ?></button>
                <a href="<?= site_url('patients') ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?= view('layouts/footer') ?>
