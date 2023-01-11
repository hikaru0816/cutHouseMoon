<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function menu() {
        return $this->belongsTo('App\Models\Menu');
    }

    public function startTime() {
        return $this->belongsTo('App\Models\StartTime');
    }
}
