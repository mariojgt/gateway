<?php

namespace mariojgt\checkout\Modules\Configuration\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{

    protected $fillable = [
        'name', 'value', 'section', 'class', 'options', 'notes'
    ];
    //
}
