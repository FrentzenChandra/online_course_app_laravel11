<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index() {
        $user = Auth::user();
        $query = Courses::with(['category', 'teacher', 'student'])->orderByDesc('id');

        if ($user->hasRole('teacher')){
            $query->whereHas('teacher' , function ($query) use ($user){
                $query->where('user_id', $user->id);
            });
        };

        $courses = $query->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }
}
