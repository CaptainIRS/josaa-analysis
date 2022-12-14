<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Course extends Model
{
    use Searchable;

    protected $keyType = 'string';

    public $incrementing = false;

    public function institutes()
    {
        return $this->belongsToMany(Institute::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }
}
