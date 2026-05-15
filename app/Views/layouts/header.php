<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title><?= $pageTitle ?? 'RehabPlus' ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        :root{

            --bg-dark:#020617;

            --sidebar-dark:#0f172a;

            --card-dark:rgba(15,23,42,.75);

            --teal:#14b8a6;

            --teal-light:#2dd4bf;

            --text-light:#f1f5f9;

            --text-muted:#94a3b8;

            --border-dark:rgba(255,255,255,.06);

            --sidebar-w:250px;

        }

        *{
            font-family:'Inter',sans-serif;
        }

        body{

            margin:0;

            background:
                radial-gradient(circle at top left,#0f766e22,transparent 25%),
                radial-gradient(circle at bottom right,#0891b222,transparent 25%),
                linear-gradient(135deg,#020617 0%,#0f172a 100%);

            color:var(--text-light);

            min-height:100vh;
        }

        /* NAVBAR */

        .navbar{

            height:70px;

            background:
                linear-gradient(
                    135deg,
                    rgba(15,23,42,.95),
                    rgba(20,184,166,.15)
                );

            backdrop-filter:blur(18px);

            border-bottom:1px solid rgba(255,255,255,.05);

            box-shadow:0 10px 30px rgba(0,0,0,.25);

            position:sticky;

            top:0;

            z-index:999;
        }

        .navbar-brand{

            font-size:1.35rem;

            font-weight:700;

            color:white !important;
        }

        .navbar-brand i{
            color:var(--teal-light);
        }

        /* USER CHIP */

        .user-chip{

            background:rgba(255,255,255,.06);

            border:1px solid rgba(255,255,255,.08);

            border-radius:50px;

            padding:.35rem .85rem .35rem .4rem;

            display:flex;

            align-items:center;

            gap:.6rem;

            backdrop-filter:blur(10px);
        }

        .user-avatar{

            width:34px;

            height:34px;

            border-radius:50%;

            background:
                linear-gradient(
                    135deg,
                    #14b8a6,
                    #0ea5e9
                );

            display:flex;

            align-items:center;

            justify-content:center;

            font-weight:700;

            color:white;
        }

        /* SIDEBAR */

        .sidebar{

            width:var(--sidebar-w);

            min-height:calc(100vh - 70px);

            background:
                linear-gradient(
                    180deg,
                    rgba(15,23,42,.97),
                    rgba(2,6,23,.98)
                );

            border-right:1px solid rgba(255,255,255,.05);

            padding:1.4rem .9rem;

            position:sticky;

            top:70px;

            backdrop-filter:blur(18px);
        }

        .nav-section{

            color:#64748b;

            font-size:.72rem;

            font-weight:700;

            letter-spacing:.12em;

            text-transform:uppercase;

            padding:.5rem .85rem;
        }

        .sidebar .nav-link{

            color:#cbd5e1;

            border-radius:16px;

            padding:.85rem 1rem;

            display:flex;

            align-items:center;

            gap:.8rem;

            transition:.2s ease;

            margin-bottom:.25rem;
        }

        .sidebar .nav-link:hover{

            background:rgba(20,184,166,.12);

            color:var(--teal-light);

            transform:translateX(2px);
        }

        .sidebar .nav-link.active{

            background:
                linear-gradient(
                    135deg,
                    rgba(20,184,166,.18),
                    rgba(14,165,233,.12)
                );

            color:white;

            border:1px solid rgba(45,212,191,.12);

            box-shadow:
                0 10px 25px rgba(20,184,166,.08);
        }

        /* MAIN */

        .main-content{

            flex:1;

            padding:2rem;
        }

        /* CARDS */

        .card{

            background:var(--card-dark) !important;

            border:1px solid rgba(255,255,255,.05);

            border-radius:24px;

            backdrop-filter:blur(18px);

            box-shadow:
                0 20px 50px rgba(0,0,0,.25);

            overflow:hidden;
        }

        .card-header{

            background:transparent !important;

            border-bottom:1px solid rgba(255,255,255,.05);

            padding:1rem 1.4rem;

            color:white;

            font-weight:600;
        }

        /* TABLES */

        .table{

            margin-bottom:0 !important;

            color:#e2e8f0 !important;

            --bs-table-bg: transparent !important;

            --bs-table-hover-bg: rgba(255,255,255,.03) !important;
        }

        .table tbody,
        .table tbody tr,
        .table tbody td{

            background:transparent !important;

            color:#e2e8f0 !important;
        }

        .table thead th{

            background:rgba(255,255,255,.03) !important;

            color:#94a3b8 !important;

            border-color:rgba(255,255,255,.05) !important;

            text-transform:uppercase;

            font-size:.75rem;

            letter-spacing:.08em;
        }

        .table td{

            border-color:rgba(255,255,255,.04) !important;

            vertical-align:middle;
        }

        .table-hover tbody tr:hover{
            background:rgba(255,255,255,.03) !important;
        }

        /* INPUTS */

        .form-control,
        .form-select,
        .input-group-text{

            background:rgba(255,255,255,.04) !important;

            border:1px solid rgba(255,255,255,.08) !important;

            color:white !important;
        }

        .form-control::placeholder{
            color:#94a3b8 !important;
        }

        .form-control:focus{

            background:rgba(255,255,255,.06) !important;

            border-color:var(--teal) !important;

            color:white !important;

            box-shadow:
                0 0 0 .2rem rgba(20,184,166,.12) !important;
        }

        /* BUTTONS */

        .btn-primary{

            background:
                linear-gradient(
                    135deg,
                    #0f766e,
                    #14b8a6
                );

            border:none;

            border-radius:14px;

            font-weight:600;
        }

        .btn-primary:hover{

            background:
                linear-gradient(
                    135deg,
                    #115e59,
                    #0d9488
                );
        }

        .btn-outline-secondary{

            border-color:rgba(255,255,255,.08);

            color:#cbd5e1;
        }

        .btn-outline-secondary:hover{

            background:rgba(255,255,255,.08);

            color:white;
        }

        /* TEXT */

        .page-title{

            font-size:1.4rem;

            font-weight:700;

            color:white;
        }

        .page-subtitle{

            color:#94a3b8;

            font-size:.9rem;
        }

        /* MOBILE */

        @media(max-width:768px){

            .sidebar{
                display:none !important;
            }

            .main-content{
                padding:1rem;
            }

        }

    </style>

</head>

<body>

<nav class="navbar navbar-dark px-4">

    <a class="navbar-brand d-flex align-items-center gap-2"
       href="<?= site_url('dashboard') ?>">

        <i class="bi bi-heart-pulse-fill fs-4"></i>

        RehabPlus

    </a>

    <div class="d-flex align-items-center gap-3">

        <span class="text-white-50 small d-none d-md-inline">
            <?= date('F j, Y') ?>
        </span>

        <div class="user-chip text-white small">

            <div class="user-avatar">
                <?= strtoupper(substr(session()->get('user_name') ?? 'U', 0, 1)) ?>
            </div>

            <span>
                <?= esc(session()->get('user_name') ?? '') ?>
            </span>

            <span class="badge bg-info text-dark">
                <?= ucfirst(session()->get('user_role') ?? '') ?>
            </span>

        </div>

        <a href="<?= site_url('logout') ?>"
           class="btn btn-sm btn-outline-light d-flex align-items-center gap-1">

            <i class="bi bi-box-arrow-right"></i>

            <span class="d-none d-md-inline">
                Logout
            </span>

        </a>

    </div>

</nav>

<div class="d-flex">

<nav class="sidebar d-none d-md-flex flex-column">

    <div class="nav-section">
        Main
    </div>

    <ul class="nav flex-column gap-1 mb-3">

        <!-- DASHBOARD -->

        <li class="nav-item">

            <a class="nav-link <?= uri_string() === '' || uri_string() === 'dashboard' ? 'active' : '' ?>"
               href="<?= site_url('dashboard') ?>">

                <i class="bi bi-speedometer2"></i>

                Dashboard

            </a>

        </li>

        <!-- PATIENTS -->

        <li class="nav-item">

            <a class="nav-link <?= str_starts_with(uri_string(), 'patients') ? 'active' : '' ?>"
               href="<?= site_url('patients') ?>">

                <i class="bi bi-people-fill"></i>

                Patients

            </a>

        </li>

        <!-- APPOINTMENTS -->

        <li class="nav-item">

            <a class="nav-link <?= str_starts_with(uri_string(), 'appointments') ? 'active' : '' ?>"
               href="<?= site_url('appointments') ?>">

                <i class="bi bi-calendar-check"></i>

                Appointments

            </a>

        </li>

        <!-- ANALYTICS -->

        <li class="nav-item">

            <a class="nav-link <?= str_starts_with(uri_string(), 'analytics') ? 'active' : '' ?>"
               href="<?= site_url('analytics') ?>">

                <i class="bi bi-activity"></i>

                Recovery Analytics

            </a>

        </li>

    </ul>

    <?php if (session()->get('user_role') === 'superadmin'): ?>

    <div class="nav-section">
        Admin
    </div>

    <ul class="nav flex-column gap-1">

        <li class="nav-item">

            <a class="nav-link <?= str_starts_with(uri_string(), 'users') ? 'active' : '' ?>"
               href="<?= site_url('users') ?>">

                <i class="bi bi-person-gear"></i>

                Users

            </a>

        </li>

    </ul>

    <?php endif ?>

</nav>

<main class="main-content">