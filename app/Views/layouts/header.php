<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'RehabPlus' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --cyan: #0e9aaa;
            --cyan-dark: #0b7a88;
            --cyan-light: #e0f7fa;
            --sidebar-w: 230px;
        }
        body { background: #f0f4f8; font-family: 'Segoe UI', sans-serif; }

        /* Navbar */
        .navbar {
            background: linear-gradient(150deg, #0b7a88 0%, #0e9aaa 50%, #17c3b2 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,.15);
            height: 58px;
        }
        .navbar-brand { font-size: 1.15rem; letter-spacing: .02em; }
        .navbar .user-chip {
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 50px;
            padding: .25rem .75rem .25rem .35rem;
            display: flex; align-items: center; gap: .5rem;
        }
        .navbar .user-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: rgba(255,255,255,.3);
            display: flex; align-items: center; justify-content: center;
            font-size: .7rem; font-weight: 700; color: #fff;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-w);
            min-height: calc(100vh - 58px);
            background: #fff;
            border-right: 1px solid #e8ecf0;
            padding: 1.25rem .75rem;
            position: sticky; top: 58px;
            box-shadow: 2px 0 8px rgba(0,0,0,.04);
        }
        .sidebar .nav-section {
            font-size: .68rem; font-weight: 700; letter-spacing: .08em;
            text-transform: uppercase; color: #adb5bd;
            padding: .5rem .75rem .25rem;
        }
        .sidebar .nav-link {
            color: #495057; border-radius: 8px;
            padding: .55rem .75rem; font-size: .875rem;
            display: flex; align-items: center; gap: .6rem;
            transition: background .15s, color .15s;
        }
        .sidebar .nav-link i { font-size: 1rem; opacity: .75; }
        .sidebar .nav-link:hover { background: var(--cyan-light); color: var(--cyan-dark); }
        .sidebar .nav-link.active {
            background: var(--cyan-light); color: var(--cyan-dark);
            font-weight: 600;
        }
        .sidebar .nav-link.active i { opacity: 1; }

        /* Main */
        .main-content { padding: 1.75rem; flex: 1; min-width: 0; }

        /* Cards */
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,.07); }
        .card-header { border-radius: 12px 12px 0 0 !important; border-bottom: 1px solid #f0f0f0; padding: .85rem 1.25rem; }
        .card-stat { border-left: 4px solid; border-radius: 12px; }
        .card-stat.patients   { border-color: #0d6efd; }
        .card-stat.compliance { border-color: #198754; }
        .card-stat.pain       { border-color: #dc3545; }

        /* Tables */
        .table thead th { font-size: .78rem; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; color: #6c757d; border-bottom: 2px solid #f0f0f0; }
        .table tbody tr:hover { background: #f8fbff; }
        .table td { vertical-align: middle; }

        /* Badges */
        .badge-pain-low  { background: #198754; }
        .badge-pain-mid  { background: #ffc107; color: #000; }
        .badge-pain-high { background: #dc3545; }
        .progress { height: 6px; border-radius: 99px; }

        /* Buttons */
        .btn-primary { background: linear-gradient(135deg, #0b7a88, #0e9aaa); border: none; }
        .btn-primary:hover { background: linear-gradient(135deg, #0a6b78, #0b7a88); border: none; }
        .btn-outline-primary { color: var(--cyan); border-color: var(--cyan); }
        .btn-outline-primary:hover { background: var(--cyan); border-color: var(--cyan); color: #fff; }
        .btn-outline-light { border-radius: 8px; }

        /* Page title */
        .page-title { font-size: 1.15rem; font-weight: 700; color: #1a2b3c; margin-bottom: 0; }
        .page-subtitle { font-size: .82rem; color: #6c757d; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('dashboard') ?>">
        <i class="bi bi-activity fs-5"></i>RehabPlus
    </a>
    <div class="d-flex align-items-center gap-3">
        <span class="text-white-50 small d-none d-md-inline"><?= date('F j, Y') ?></span>
        <div class="user-chip text-white small">
            <div class="user-avatar"><?= strtoupper(substr(session()->get('user_name') ?? 'U', 0, 1)) ?></div>
            <span><?= esc(session()->get('user_name') ?? '') ?></span>
            <span class="badge bg-white text-dark ms-1" style="font-size:.65rem;"><?= ucfirst(session()->get('user_role') ?? '') ?></span>
        </div>
        <a href="<?= site_url('logout') ?>" class="btn btn-sm btn-outline-light d-flex align-items-center gap-1">
            <i class="bi bi-box-arrow-right"></i><span class="d-none d-md-inline">Logout</span>
        </a>
    </div>
</nav>

<div class="d-flex">
<nav class="sidebar d-none d-md-flex flex-column">
    <div class="nav-section">Main</div>
    <ul class="nav flex-column gap-1 mb-3">
        <li class="nav-item">
            <a class="nav-link <?= uri_string() === '' || uri_string() === 'dashboard' ? 'active' : '' ?>" href="<?= site_url('dashboard') ?>">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= str_starts_with(uri_string(), 'patients') ? 'active' : '' ?>" href="<?= site_url('patients') ?>">
                <i class="bi bi-people"></i>Patients
            </a>
        </li>
    </ul>
    <?php if (session()->get('user_role') === 'superadmin'): ?>
    <div class="nav-section">Admin</div>
    <ul class="nav flex-column gap-1">
        <li class="nav-item">
            <a class="nav-link <?= str_starts_with(uri_string(), 'users') ? 'active' : '' ?>" href="<?= site_url('users') ?>">
                <i class="bi bi-person-gear"></i>Users
            </a>
        </li>
    </ul>
    <?php endif ?>
</nav>
<main class="main-content">
