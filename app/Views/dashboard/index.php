<?php $pageTitle = 'Dashboard – RehabPlus'; ?>
<?= view('layouts/header') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="page-title"><i class="bi bi-speedometer2 me-2 text-cyan" style="color:#0e9aaa;"></i>Dashboard</p>
        <p class="page-subtitle mb-0">Clinical overview — <?= date('F j, Y') ?></p>
    </div>
    <a href="<?= site_url('patients/create') ?>" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
        <i class="bi bi-plus-lg"></i>Add Patient
    </a>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-stat patients shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small mb-1">Total Patients</div>
                    <div class="fs-2 fw-bold text-primary"><?= $totalPatients ?></div>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:52px;height:52px;background:#e8f0fe;">
                    <i class="bi bi-people-fill fs-4 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat compliance shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small mb-1">Avg. Compliance Rate</div>
                    <div class="fs-2 fw-bold text-success"><?= $avgCompliance ?>%</div>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:52px;height:52px;background:#e6f4ea;">
                    <i class="bi bi-check2-circle fs-4 text-success"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat pain shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted small mb-1">Avg. Pain Level (0–10)</div>
                    <div class="fs-2 fw-bold text-danger"><?= $avgPain ?></div>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:52px;height:52px;background:#fce8e8;">
                    <i class="bi bi-heart-pulse-fill fs-4 text-danger"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Patient Recovery Overview -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
        <span><i class="bi bi-table me-2" style="color:#0e9aaa;"></i>Patient Recovery Overview</span>
        <a href="<?= site_url('patients') ?>" class="btn btn-sm btn-outline-secondary">View All</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Patient</th>
                    <th>Condition</th>
                    <th>Sessions</th>
                    <th style="width:180px">Compliance</th>
                    <th>Avg. Pain</th>
                    <th>Recovery</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($patientStats)): ?>
                <tr><td colspan="7" class="text-center text-muted py-5">
                    <i class="bi bi-inbox fs-3 d-block mb-2 opacity-50"></i>No data available.
                </td></tr>
            <?php else: ?>
                <?php foreach ($patientStats as $p):
                    $compliance = (float)($p['compliance_rate'] ?? 0);
                    $pain       = (float)($p['avg_pain'] ?? 0);
                    $recovery   = (float)($p['recovery_score'] ?? 0);
                    $barClass   = $compliance >= 80 ? 'bg-success' : ($compliance >= 50 ? 'bg-warning' : 'bg-danger');
                    $painClass  = $pain <= 3 ? 'badge-pain-low' : ($pain <= 6 ? 'badge-pain-mid' : 'badge-pain-high');
                ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <span class="rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold"
                                  style="width:32px;height:32px;font-size:.75rem;background:#0e9aaa;">
                                <?= strtoupper(substr($p['name'], 0, 1)) ?>
                            </span>
                            <a href="<?= site_url('patients/' . $p['id']) ?>" class="fw-semibold text-decoration-none text-dark"><?= esc($p['name']) ?></a>
                        </div>
                    </td>
                    <td class="text-muted small"><?= esc($p['condition']) ?></td>
                    <td><?= $p['total_sessions'] ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="progress flex-grow-1">
                                <div class="progress-bar <?= $barClass ?>" style="width:<?= min($compliance,100) ?>%"></div>
                            </div>
                            <span class="small fw-semibold"><?= $compliance ?>%</span>
                        </div>
                    </td>
                    <td><span class="badge <?= $painClass ?>"><?= $pain ?> / 10</span></td>
                    <td>
                        <?php if ($recovery >= 60): ?>
                            <span class="text-success fw-semibold small"><i class="bi bi-arrow-up-circle-fill me-1"></i><?= $recovery ?></span>
                        <?php elseif ($recovery >= 30): ?>
                            <span class="text-warning fw-semibold small"><i class="bi bi-dash-circle-fill me-1"></i><?= $recovery ?></span>
                        <?php else: ?>
                            <span class="text-danger fw-semibold small"><i class="bi bi-arrow-down-circle-fill me-1"></i><?= $recovery ?></span>
                        <?php endif; ?>
                    </td>
                    <td><a href="<?= site_url('patients/' . $p['id']) ?>" class="btn btn-sm btn-outline-secondary">View</a></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Exercise Records -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white fw-semibold">
        <i class="bi bi-clock-history me-2" style="color:#0e9aaa;"></i>Recent Exercise Records
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Patient</th>
                    <th>Exercise</th>
                    <th>Sets (Done / Rx)</th>
                    <th>Pain Level</th>
                    <th>Recorded At</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($recentRecords)): ?>
                <tr><td colspan="5" class="text-center text-muted py-5">
                    <i class="bi bi-inbox fs-3 d-block mb-2 opacity-50"></i>No records yet.
                </td></tr>
            <?php else: ?>
                <?php foreach ($recentRecords as $r):
                    $pain      = (int)$r['pain_level'];
                    $painClass = $pain <= 3 ? 'badge-pain-low' : ($pain <= 6 ? 'badge-pain-mid' : 'badge-pain-high');
                ?>
                <tr>
                    <td><a href="<?= site_url('patients/' . $r['patient_id']) ?>" class="text-decoration-none fw-semibold"><?= esc($r['patient_name']) ?></a></td>
                    <td><?= esc($r['exercise_name']) ?></td>
                    <td><span class="fw-semibold"><?= $r['sets_completed'] ?></span> / <?= $r['sets_prescribed'] ?></td>
                    <td><span class="badge <?= $painClass ?>"><?= $pain ?> / 10</span></td>
                    <td class="text-muted small"><?= date('M j, Y g:i A', strtotime($r['recorded_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('layouts/footer') ?>
