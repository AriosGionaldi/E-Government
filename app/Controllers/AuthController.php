<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    // Tampilkan halaman otentikasi (login/register)
    public function login()
    {
        return view('auth/auth');
    }

    // Proses login
    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan username
        $user = $userModel->where('username', $username)->first();

        // Jika user tidak ditemukan atau password tidak cocok
        if (!$user || sha1($password) !== $user['password']) {
            return redirect()->back()->with('error', 'Username atau password anda salah.');
        }

        // Jika status akun tidak aktif
        if ($user['status'] === 'Tidak Aktif') {
            return redirect()->back()->with('error', 'Maaf, akun anda telah dinonaktifkan. Silahkan hubungi admin.');
        }

        // Set session jika login berhasil
        $session->set([
            'id_user' => $user['id_user'],
            'username' => $user['username'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    // Proses registrasi
    public function attemptRegister()
    {
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email'); // Opsional: hapus jika tidak digunakan
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($password !== $confirmPassword) {
            return redirect()->back()->with('error_reg', 'Password dan konfirmasi tidak cocok.');
        }

        // Cek apakah username sudah ada
        $existingUser = $userModel->where('username', $username)->first();
        if ($existingUser) {
            return redirect()->back()->with('error_reg', 'Username sudah digunakan.');
        }

        // Siapkan data untuk disimpan (menggunakan enkripsi SHA1)
        $data = [
            'username' => $username,
            'password' => sha1($password),
            'status' => 'Aktif'
        ];

        if ($email) {
            $data['email'] = $email;
        }

        $userModel->insert($data);

        return redirect()->back()->with('success_reg', 'Registrasi berhasil, silakan login.');
    }

    // Proses logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}