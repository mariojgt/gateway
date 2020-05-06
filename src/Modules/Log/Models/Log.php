<?php

namespace mariojgt\checkout\Modules\Log\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
}
