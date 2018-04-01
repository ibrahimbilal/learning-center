<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Session extends Model
{
    use SoftDeletes;
    protected $table = 'sessions';

    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo('App\Room', 'room_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'teacher_id', 'id');
    }
}
