<?php $pageTitle = 'User Management – RehabPlus'; ?>
<?= view('layouts/header') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
        <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="page-title"><i class="bi bi-person-gear me-2" style="color:#0e9aaa;"></i>User Management</p>
        <p class="page-subtitle mb-0">Manage system users and their roles</p>
    </div>
    <a href="<?= site_url('users/create') ?>" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
        <i class="bi bi-plus-lg"></i>Add User
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            <?php if (empty($users)): ?>
                <tr><td colspan="5" class="text-center text-muted py-5">
                    <i class="bi bi-people fs-3 d-block mb-2 opacity-50"></i>No users found.
                </td></tr>
            <?php else: ?>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <span class="rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold"
                                  style="width:34px;height:34px;font-size:.75rem;background:#0e9aaa;flex-shrink:0;">
                                <?= strtoupper(substr($u['name'], 0, 1)) ?>
                            </span>
                            <span class="fw-semibold"><?= esc($u['name']) ?></span>
                        </div>
                    </td>
                    <td class="text-muted small align-middle"><?= esc($u['email']) ?></td>
                    <td class="align-middle">
                        <span class="badge rounded-pill bg-<?= $u['role'] === 'superadmin' ? 'danger' : ($u['role'] === 'manager' ? 'warning text-dark' : 'secondary') ?>">
                            <?= ucfirst($u['role']) ?>
                        </span>
                    </td>
                    <td class="align-middle">
                        <span class="badge rounded-pill bg-<?= $u['is_active'] ? 'success' : 'secondary' ?>">
                            <?= $u['is_active'] ? 'Active' : 'Inactive' ?>
                        </span>
                    </td>
                    <td class="text-end align-middle">
                        <a href="<?= site_url('users/' . $u['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                        <form method="post" action="<?= site_url('users/' . $u['id'] . '/delete') ?>" class="d-inline"
                              onsubmit="return confirm('Delete this user?')">
                            <?= csrf_field() ?>
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach ?>
            <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3"><?= $pager->links() ?></div>

<?= view('layouts/footer') ?>
