<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\MeetingReportModel;

class CompanyReport extends Seeder
{
    public function run()
    {
        $meeting= new MeetingReportModel();
        $services= new \App\Models\InterestServicesModel();
        $faker=\Faker\Factory::create();
        $desg=["Manager","CEO","Officer","Executive","Owner","Support","Employ"];
        for($i=1;$i<=20;$i++)
        {
                $meeting->save([
                    "company_id"=>rand(37,40),
                    "user_id"=>"1",
                    "contact_person"=> $faker->name(),
                    "desg" =>$desg[rand(0,6)],
                    "mobile"=>$faker->unique()->phoneNumber(),
                    "email"=>$faker->unique()->safeEmail(),
                    "summary"=>$faker->text(),
                ]);
                
        }
    }
}
