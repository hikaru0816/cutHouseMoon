<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StartTime extends Model {
    public $timestamps = false;

    public function reservations() {
        return $this->hasMany("App\Models\Resevations");
    }
}
