<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // Pastikan nama tabel sesuai dengan database Anda
    protected $primaryKey = 'id_user';
    // Jika struktur database asli hanya memiliki kolom username, password, dan status,
    // hapus 'email' dari allowedFields.
    protected $allowedFields = ['username', 'password', 'status', 'email'];
}