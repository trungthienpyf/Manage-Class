<?php

namespace Database\Seeders;

use App\Models\ClassSchedule;
use App\Models\ClassStudent;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Student::factory(30)->create();
        \App\Models\Teacher::factory(10)->create();
        \App\Models\Room::factory(10)->create();
        \App\Models\Subject::factory(5)->create();
        $faker = \Faker\Factory::create('vi_VN');
        $arr = [];
        for ($i = 1; $i <= 5; $i++) {
            $arr[] = [
                'teacher_id' => Teacher::query()->inRandomOrder()->value('id'),
                'subject_id' => Subject::query()->inRandomOrder()->value('id'),

                'time_start' => Carbon::now(),
                'time_end' => Carbon::now()->addMonths(1),
                'weekdays' => '1',
                'shift' => '1',
                'room_id' => \App\Models\Room::query()->inRandomOrder()->value('id')
            ];


        }

        ClassSchedule::insert($arr);
        $classIds = ClassSchedule::query()->pluck('id');
        $studentIds = Student::query()->pluck('id');


        //  $class->students()->sync([1,2]);

        $this->runStudent($classIds, $studentIds);


    }

    public function runStudent($classIds, $studentIds)
    {
        $faker = \Faker\Factory::create();
        foreach (range(1, 50) as $index) {
            $class = ClassSchedule::find($faker->randomElement($classIds));

            $class->students()->sync(array($faker->randomElement($studentIds)));
        }
    }
}
