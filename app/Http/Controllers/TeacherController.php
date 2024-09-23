<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException ;


class TeacherController extends Controller
{
    public function index() {
        $teachers = Teacher::orderByDesc('id')->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create(){
        return view('admin.teachers.create');
    }

    public function store(StoreTeacherRequest $request) {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if(!$user){
            return back()->withErrors([
                'email' => "Data tidak Ditemukan"
            ]);
        }

        DB::transaction(function () use ($user,$validated) {
            $validated['user_id'] = $user->id;
            $validated['is_active'] = true;

            Teacher::create($validated);

            if ($user->hasRole('student')) {
                $user->removeRole('student');
            }

            $user->assignRole('teacher');
        });

        return redirect()->route('admin.teachers.index');
    }

    public function destroy(Teacher $teacher) {
        try {
            $teacher->delete();

            $user = User::find($teacher->user_id);
            $user->removeRole('teacher');
            $user->assignRole('student');

            return redirect()->back();
        }catch(\Exception $e){
            DB::rollBack();

            $error = ValidationException::withMessages([
                'system_error' => ['System Error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
