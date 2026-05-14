<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'role', 'avatar', 'is_active'];
    protected $useTimestamps = true;
    protected $hidden        = ['password'];

    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->where('is_active', 1)->first();
    }

    public function getByRole(string $role): array
    {
        return $this->where('role', $role)->findAll();
    }
}
