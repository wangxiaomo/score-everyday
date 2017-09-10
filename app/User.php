<?php

namespace App;

use App\UserScoreLog;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Redis;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function get_score() {
        $id = $this->id;
        $year = date('Y');
        $key = "score_everyday:user_$id:$year";
        return Redis::hgetall($key);
    }

    public function incr($step) {
        $id = $this->id;
        $year = date('Y');
        $key = "score_everyday:user_$id:$year";
        $v = Redis::hget($key, date('Y/m/d'));
        $v = $v+intval($step);
        if($v>10) $v=10;if($v<-10) $v=-10;
        Redis::hset($key, date('Y/m/d'), $v);
        UserScoreLog::create(['uid'=>$id, 'step'=>$step]);
        return $v;
    }
}
