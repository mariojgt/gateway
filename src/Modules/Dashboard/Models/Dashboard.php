<?php

namespace mariojgt\checkout\Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboard extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
}
