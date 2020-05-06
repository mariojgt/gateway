<?php

namespace mariojgt\checkout\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
}
