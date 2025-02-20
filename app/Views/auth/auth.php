<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login & Registrasi | E-Government</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    body {
        background: #141414 url('https://via.placeholder.com/1920x1080/000000/FFFFFF?text=Dark+Background') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
    }

    /* Wrapper flex full-height untuk center secara vertikal dan horizontal */
    .full-height {
        min-height: 100vh;
    }

    .auth-card {
        background-color: #1f1f1f;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        max-width: 450px;
        width: 100%;
        padding: 2rem;
    }

    .auth-title {
        font-size: 1.4rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .auth-title i {
        font-size: 1.6rem;
    }

    .form-control {
        border-radius: 8px;
        background-color: #2b2b2b;
        border: 1px solid #444;
        color: #fff;
    }

    .form-control:focus {
        background-color: #2b2b2b;
        color: #fff;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.25);
        border-color: #00b4d8;
    }

    .btn-custom {
        border-radius: 8px;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .btn-custom:hover {
        background-color: #0090b0 !important;
    }

    .alert {
        border-radius: 8px;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .alert::before {
        margin-right: 5px;
        font-weight: 600;
    }

    /* Sembunyikan form registrasi secara default */
    #registerForm {
        display: none;
    }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center full-height">
        <div class="auth-card">
            <!-- FORM LOGIN -->
            <div id="loginForm">
                <div class="auth-title">
                    <i class="fas fa-user"></i>
                    <span>Login</span>
                </div>

                <!-- Flashdata Error (Login) -->
                <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <div class="mb-3">
                        <label for="login_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="login_username" name="username"
                            placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label for="login_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login_password" name="password"
                            placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-custom w-100">Login</button>
                </form>

                <div class="text-center mt-3">
                    <small>Belum punya akun?</small>
                    <button class="btn btn-link text-decoration-none text-info p-0"
                        onclick="showRegister()">Register</button>
                </div>
            </div>

            <!-- FORM REGISTER -->
            <div id="registerForm">
                <div class="auth-title">
                    <i class="fas fa-user-plus"></i>
                    <span>Register</span>
                </div>

                <!-- Flashdata Error/Success (Register) -->
                <?php if (session()->getFlashdata('error_reg')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error_reg') ?>
                </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success_reg')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success_reg') ?>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('register') ?>" method="post">
                    <div class="mb-3">
                        <label for="reg_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="reg_username" name="username"
                            placeholder="Masukkan username" required>
                    </div>
                    <!-- Jika database tidak menggunakan email, hapus field ini -->
                    <div class="mb-3">
                        <label for="reg_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="reg_email" name="email"
                            placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-3">
                        <label for="reg_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="reg_password" name="password"
                            placeholder="Masukkan password" required>
                    </div>
                    <div class="mb-3">
                        <label for="reg_confirm_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="reg_confirm_password" name="confirm_password"
                            placeholder="Ulangi password" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-custom w-100">Register</button>
                </form>

                <div class="text-center mt-3">
                    <small>Sudah punya akun?</small>
                    <button class="btn btn-link text-decoration-none text-info p-0" onclick="showLogin()">Login</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>

    <script>
    function showRegister() {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registerForm').style.display = 'block';
    }

    function showLogin() {
        document.getElementById('registerForm').style.display = 'none';
        document.getElementById('loginForm').style.display = 'block';
    }
    </script>
</body>

</html>