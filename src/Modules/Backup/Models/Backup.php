<?php

namespace mariojgt\gateway\Modules\Backup\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Backup extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
}
