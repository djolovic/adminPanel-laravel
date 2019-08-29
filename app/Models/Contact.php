<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = ['id'];

    public function isResolved(): bool
    {
        return ($this->resolved === 0) ? false : true;
    }
}
