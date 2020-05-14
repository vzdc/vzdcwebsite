<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    protected $fillable = ['id', 'student_cid', 'student_name', 'student_rating', 'instructor_cid', 'instructor_name', 
                            'exam_id', 'exam_name', 'accepted', 'assigned', 'requested_at', 'accepted_at', 'assigned_at'];
}
