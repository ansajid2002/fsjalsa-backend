<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    const UPDATED_AT = null; // This disables the updated_at column
    protected $fillable = ['email', 'token'];
}
