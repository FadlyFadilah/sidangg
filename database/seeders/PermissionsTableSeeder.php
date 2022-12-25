<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'management_mahasiswa_access',
            ],
            [
                'id'    => 18,
                'title' => 'mahasiswa_create',
            ],
            [
                'id'    => 19,
                'title' => 'mahasiswa_edit',
            ],
            [
                'id'    => 20,
                'title' => 'mahasiswa_show',
            ],
            [
                'id'    => 21,
                'title' => 'mahasiswa_delete',
            ],
            [
                'id'    => 22,
                'title' => 'mahasiswa_access',
            ],
            [
                'id'    => 23,
                'title' => 'orangtua_create',
            ],
            [
                'id'    => 24,
                'title' => 'orangtua_edit',
            ],
            [
                'id'    => 25,
                'title' => 'orangtua_show',
            ],
            [
                'id'    => 26,
                'title' => 'orangtua_delete',
            ],
            [
                'id'    => 27,
                'title' => 'orangtua_access',
            ],
            [
                'id'    => 28,
                'title' => 'syarat_create',
            ],
            [
                'id'    => 29,
                'title' => 'syarat_edit',
            ],
            [
                'id'    => 30,
                'title' => 'syarat_show',
            ],
            [
                'id'    => 31,
                'title' => 'syarat_delete',
            ],
            [
                'id'    => 32,
                'title' => 'syarat_access',
            ],
            [
                'id'    => 33,
                'title' => 'pembimbing_create',
            ],
            [
                'id'    => 34,
                'title' => 'pembimbing_edit',
            ],
            [
                'id'    => 35,
                'title' => 'pembimbing_show',
            ],
            [
                'id'    => 36,
                'title' => 'pembimbing_delete',
            ],
            [
                'id'    => 37,
                'title' => 'pembimbing_access',
            ],
            [
                'id'    => 38,
                'title' => 'penguji_create',
            ],
            [
                'id'    => 39,
                'title' => 'penguji_edit',
            ],
            [
                'id'    => 40,
                'title' => 'penguji_show',
            ],
            [
                'id'    => 41,
                'title' => 'penguji_delete',
            ],
            [
                'id'    => 42,
                'title' => 'penguji_access',
            ],
            [
                'id'    => 43,
                'title' => 'nilai_create',
            ],
            [
                'id'    => 44,
                'title' => 'nilai_edit',
            ],
            [
                'id'    => 45,
                'title' => 'nilai_show',
            ],
            [
                'id'    => 46,
                'title' => 'nilai_delete',
            ],
            [
                'id'    => 47,
                'title' => 'nilai_access',
            ],
            [
                'id'    => 48,
                'title' => 'dosenpembimbing_access',
            ],
            [
                'id'    => 49,
                'title' => 'dosenpenguji_access',
            ],
            [
                'id'    => 50,
                'title' => 'skpi_create',
            ],
            [
                'id'    => 51,
                'title' => 'skpi_edit',
            ],
            [
                'id'    => 52,
                'title' => 'skpi_show',
            ],
            [
                'id'    => 53,
                'title' => 'skpi_delete',
            ],
            [
                'id'    => 54,
                'title' => 'skpi_access',
            ],
            [
                'id'    => 55,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
