<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserScoreLog extends Model {
    protected $fillable = ['uid', 'step'];
}
