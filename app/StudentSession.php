<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSession extends Model
{
    protected $table = 'students_sessions';

    public function hasStudent() {
      return $this->belongsTo('App\Student', 'student_id', 'id');
    }

    public function hasSession() {
      return $this->belongsTo('App\Session', 'session_id', 'id');
    }
}
