<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Emergency extends Seeder
{
    public function run()
    {
        $contact=new \App\Models\Contacts();
        
        $faker=\Faker\Factory::create();
       $desg=["","Executive","Manager","Support","Hr","Developer"];
       $num=["","017","018","019","016"];
        for($i=1;$i<=100;$i++)
        {
                $contact->save([
                    "name"=>$faker->name(),
                    "designation"=>$desg[rand(1,5)],
                    "contact"=> $num[rand(1,4)].rand(00000001,99999999),
                   
                  
                ]);
                
        }
    }
}
