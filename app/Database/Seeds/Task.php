<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\AssignTaskModel;

class Task extends Seeder
{
    public function run()
    {
        $tasks= new AssignTaskModel();
        
        $faker=\Faker\Factory::create();
       
        for($i=1;$i<=100;$i++)
        {
                $tasks->save([
                    "to_id"=>rand(1,7),
                    "msg"=>$faker->text(),
                    "job_date"=> $faker->date(),
                    "end_date"=>$faker->date(),
                    "complete" =>'1',
                  
                ]);
                
        }
    }
}
