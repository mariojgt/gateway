<?php

namespace DummyNamespace\Modules\DummyModuleName\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DummyModuleName extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
}
