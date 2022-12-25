<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dosen extends Model
{
    use HasFactory;
    
    public function dosenUser()
    {
        $query = "SELECT
                        *
                    FROM users
                    JOIN role_user ON users.id = role_user.user_id
                    JOIN roles ON roles.id = role_user.role_id
                    WHERE roles.title = 'Dosen'";
        return DB::select($query);
    }

    
}
