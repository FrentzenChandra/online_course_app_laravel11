<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // menambahkan daftar list role yang ada
        // owner
        $ownerRole = Role::create([
            'name' => 'owner',
        ]);
        // student
        $studentRole = Role::create([
            'name' => 'student',
        ]);
        // teacher
        $teacherRole = Role::create([
            'name' => 'teacher',
        ]);

        // Menambahkan data owner
        $userOwner = User::Create([
            'name' => "Acen terus",
            'occupation' => "Gurus",
            'avatar' => "images/default-avatar.png",
            'email' => "acen@gmail.com",
            'password' => bcrypt("123123"),
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
