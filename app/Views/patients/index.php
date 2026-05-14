<?php $pageTitle = 'Patients – RehabPlus'; ?>
<?= view('layouts/header') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
        <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="page-title"><i class="bi bi-people me-2" style="color:#0e9aaa;"></i>Patients</p>
        <p class="page-subtitle mb-0">Manage and track all registered patients</p>
    </div>
    <a href="<?= site_url('patients/create') ?>" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
        <i class="bi bi-plus-lg"></i>Add Patient
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Patient</th><th>Condition</th><th>Added</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            <?php if (empty($data)): ?>
                <tr><td colspan="4" class="text-center text-muted py-5">
                    <i class="bi bi-people fs-3 d-block mb-2 opacity-50"></i>No patients found.
                </td></tr>
            <?php else: ?>
                <?php foreach ($data as $p): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <?php if (!empty($p['avatar'])): ?>
                                <img src="<?= base_url('uploads/avatars/' . $p['avatar']) ?>" class="rounded-circle" width="38" height="38" style="object-fit:cover;">
                            <?php else: ?>
                                <span class="rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold"
                                      style="width:38px;height:38px;font-size:.8rem;background:#0e9aaa;flex-shrink:0;">
                                    <?= strtoupper(substr($p['name'], 0, 1)) ?>
                                </span>
                            <?php endif ?>
                            <a href="<?= site_url('patients/' . $p['id']) ?>" class="fw-semibold text-decoration-none text-dark"><?= esc($p['name']) ?></a>
                        </div>
                    </td>
                    <td class="text-muted small align-middle"><?= esc($p['condition']) ?></td>
                    <td class="text-muted small align-middle"><?= date('M j, Y', strtotime($p['created_at'])) ?></td>
                    <td class="text-end align-middle">
                        <a href="<?= site_url('patients/' . $p['id']) ?>" class="btn btn-sm btn-outline-secondary me-1">View</a>
                        <a href="<?= site_url('patients/' . $p['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                        <form method="post" action="<?= site_url('patients/' . $p['id'] . '/delete') ?>" class="d-inline"
                              onsubmit="return confirm('Delete this patient and all their records?')">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3"><?= $pager->links() ?></div>

<?= view('layouts/footer') ?>
