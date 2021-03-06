<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonContent extends Model
{
    public function lessonDetail()
    {
        return $this->belongsTo(LessonDetail::class);
    }

    public function lessonAnswer()
    {
        return $this->hasMany(LessonAnswer::class);
    }

    public static function findLessonByID($lesson_detail_id)
    {
        return LessonContent::where('lesson_detail_id', $lesson_detail_id)->first();
    }

    public static function checkContentByDetailId($id)
    {
        return LessonContent::where('lesson_detail_id', $id)->exists();
    }
}
