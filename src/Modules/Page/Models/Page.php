<?php

namespace mariojgt\gateway\Modules\Page\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
}
