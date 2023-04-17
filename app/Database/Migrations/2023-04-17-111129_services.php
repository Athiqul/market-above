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
                "constraint"=>12,
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
                "constraint"=>255,
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
        $this->forge->addForeignKey('user_id','user_access','id','CASCADE','CASCADE');
        $this->forge->createTable('user_info');
    }

    public function down()
    {
        //
    }
}
