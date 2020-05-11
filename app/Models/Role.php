<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const ADMIN_SLUG = 'admin';
    public const USER_SLUG = 'user';

    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Get the users for the role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
