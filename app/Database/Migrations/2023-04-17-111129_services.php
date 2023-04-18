<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmployActivity extends Migration
{
    public function up()
    {
        $this->forge->addField([

            "id"=>[
                "type"=>'INT',
                "constraint"=>4,
                "unsigned"=>true,
                "auto_increment"=>true
            ],
           
            "service_name"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,
                "null"=>true
            ],
            "status"=>[
                "type"=>"ENUM",
                "constraint"=>['0','1'],
                "null"=>true
            ],
            
            "created_at"=>[
                "type"=>"DATETIME",
                "null"=>true
            ],
            "updated_at"=>[
                "type"=>"DATETIME",
                "null"=>true
            ]
            

        ]);

        $this->forge->addPrimaryKey('id');
       
        $this->forge->createTable('services');
    }

    public function down()
    {
        $this->forge->dropTable('services');
    }
}
