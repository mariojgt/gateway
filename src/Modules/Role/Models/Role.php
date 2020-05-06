<?php

namespace mariojgt\checkout\Modules\Role\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use mariojgt\checkout\Modules\Admin\Models\Admin;

class Role extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'description'
    ];

    //
    public function Admin($value = '')
    {
        return $this->belongsToMany(Admin::class);
    }
}
