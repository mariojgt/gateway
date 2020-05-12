<?php

namespace mariojgt\gateway\Modules\Media\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
}
