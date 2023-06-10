<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Authorization extends Migration
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
           
          

            "otp"=>[
                "type"=>'VARCHAR',
                "constraint"=>255,
                "null"=>true
            ],

            "user_id"=>[
                "type"=>'VARCHAR',
                "constraint"=>255,
                "null"=>true
            ],
            

            "match"=>[
                "type"=>'ENUM',
                "constraint"=>['0','1'],
                "default"=>"0",
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
      
        $this->forge->createTable('recovery');
    }

    public function down()
    {
        $this->forge->dropTable('recovery');
    }
}
