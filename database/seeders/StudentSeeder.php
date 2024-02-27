<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\ClassroomStudent;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory(40)->create();
        $students = Student::all();
        $section = 1;
        $count = 1;
        foreach ($students as $student) {
            $cycle = 1;
            $level = 2;
            $grade = 4;

            $classrooms = DB::table('classrooms')->select('id')->where('cycle_id', $cycle)
                ->where('level_id', $level)
                ->where('grade_id', $grade)
                ->where('section_id', $section)
                ->first();
            ClassroomStudent::factory(1)->create(
                [
                    'student_id' => $student->id,
                    'classroom_id' => $classrooms->id,
                ]
            );
            $cycle++;
            $grade++;
            if ($count == 20) {
                $section = 2;
            }
            if ($count == 40) {
                $section = 1;
            }
            if ($count == 60) {
                $section = 2;
            }
            if ($count == 80) {
                $section = 1;
            }

            $classrooms = DB::table('classrooms')->select('id')->where('cycle_id', $cycle)
                ->where('level_id', $level)
                ->where('grade_id', $grade)
                ->where('section_id', $section)
                ->first();
            ClassroomStudent::factory(1)->create(
                [
                    'student_id' => $student->id,
                    'classroom_id' => $classrooms->id,
                ]
            );
            $count++;
        }
    }
}
