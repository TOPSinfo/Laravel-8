<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as Permissions;

class Permission extends Permissions
{
    use HasFactory;
    protected $table    = 'permissions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
        'status',
        'module_id'

    ];

    /**
     * Get the author that wrote the book.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
