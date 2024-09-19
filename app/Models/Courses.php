<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Courses extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'path_trailer',
        'about',
        'thumbnail',
        'category_id',
        'teacher_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function course_keypoints(){
        return $this->hasMany(Course_Keypoint::class);
    }

    public function course_students(){
        return $this->hasMany(User::class , "Course_Student");
    }

}
