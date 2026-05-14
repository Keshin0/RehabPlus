<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In – RehabPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { margin:0; min-height:100vh; display:flex; background:#f4f6f9; font-family:'Segoe UI',sans-serif; }

        .left-panel {
            width: 42%;
            background: linear-gradient(150deg, #0b7a88 0%, #0e9aaa 50%, #17c3b2 100%);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 3rem; color: #fff; position: relative; overflow: hidden;
        }
        .left-panel::before {
            content: ''; position: absolute;
            width: 350px; height: 350px; border-radius: 50%;
            background: rgba(255,255,255,.06);
            top: -80px; right: -80px;
        }
        .left-panel::after {
            content: ''; position: absolute;
            width: 250px; height: 250px; border-radius: 50%;
            background: rgba(255,255,255,.06);
            bottom: -60px; left: -60px;
        }
        .left-panel .brand-icon { font-size: 3.5rem; margin-bottom: 1rem; }
        .left-panel h1 { font-size: 2rem; font-weight: 700; margin-bottom: .5rem; }
        .left-panel p { font-size: .9rem; opacity: .8; text-align: center; max-width: 260px; line-height: 1.6; }
        .left-panel .badge-role {
            margin-top: 2rem;
            background: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 50px; padding: .4rem 1.2rem;
            font-size: .78rem; letter-spacing: .06em; text-transform: uppercase;
        }
        .feature-list { list-style: none; padding: 0; margin-top: 2rem; text-align: left; }
        .feature-list li { font-size: .82rem; opacity: .85; margin-bottom: .5rem; display: flex; align-items: center; gap: .5rem; }

        .right-panel { flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .login-box { width: 100%; max-width: 420px; }
        .login-box h4 { font-weight: 700; color: #1a2b3c; margin-bottom: .25rem; font-size: 1.4rem; }
        .login-box .subtitle { color: #6c757d; font-size: .875rem; margin-bottom: 2rem; }

        .form-label { font-weight: 600; font-size: .82rem; color: #344054; }
        .form-control, .input-group-text {
            border-radius: 8px; font-size: .9rem;
            border: 1.5px solid #d0d5dd;
        }
        .input-group .form-control { border-radius: 0 8px 8px 0; border-left: none; }
        .input-group .input-group-text:first-child { border-radius: 8px 0 0 8px; border-right: none; }
        .input-group .input-group-text:last-child { border-radius: 0 8px 8px 0; border-left: none; }
        .form-control { padding: .65rem 1rem; }
        .form-control:focus { border-color: #0e9aaa; box-shadow: 0 0 0 3px rgba(14,154,170,.15); }

        .btn-signin {
            background: linear-gradient(135deg, #0b7a88, #0e9aaa);
            border: none; border-radius: 8px;
            padding: .75rem; font-size: .95rem; font-weight: 600;
            letter-spacing: .02em; transition: opacity .2s;
        }
        .btn-signin:hover { opacity: .88; }

        .divider { border-top: 1px solid #e4e7ec; margin: 1.5rem 0; }
        .footer-note { text-align: center; font-size: .78rem; color: #98a2b3; }

        @media (max-width: 768px) { .left-panel { display: none; } }
    </style>
</head>
<body>

<div class="left-panel d-none d-md-flex">
    <i class="bi bi-activity brand-icon"></i>
    <h1>RehabPlus</h1>
    <p>Rehabilitation management system for clinical professionals.</p>
    <ul class="feature-list">
        <li><i class="bi bi-check-circle-fill"></i> Patient progress tracking</li>
        <li><i class="bi bi-check-circle-fill"></i> Exercise compliance monitoring</li>
        <li><i class="bi bi-check-circle-fill"></i> Pain level analytics</li>
    </ul>
    <span class="badge-role"><i class="bi bi-shield-lock me-1"></i>Secure Portal</span>
</div>

<div class="right-panel">
    <div class="login-box">

        <div class="text-center mb-4 d-md-none">
            <i class="bi bi-activity" style="font-size:2.5rem;color:#0e9aaa;"></i>
            <div class="fw-bold fs-4" style="color:#0e9aaa;">RehabPlus</div>
        </div>

        <h4>Welcome back</h4>
        <p class="subtitle">Sign in to your account to continue</p>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success py-2 small d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger py-2 small d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-circle-fill"></i>
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif ?>

        <form action="<?= site_url('login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control border-start-0 ps-0"
                           placeholder="you@rehabplus.com"
                           value="<?= esc(old('email')) ?>" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password" name="password" id="passwordInput"
                           class="form-control border-start-0 ps-0 border-end-0"
                           placeholder="••••••••" required>
                    <span class="input-group-text bg-white" style="cursor:pointer;" onclick="togglePassword()">
                        <i class="bi bi-eye text-muted" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-signin btn-primary w-100 text-white">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>
        </form>

        <div class="divider"></div>
        <p class="footer-note"><i class="bi bi-shield-check me-1"></i>Secured access — authorised personnel only</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
</body>
</html>
