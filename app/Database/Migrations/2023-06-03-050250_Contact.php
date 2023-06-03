<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contact extends Migration
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
           
          

            "name"=>[
                "type"=>'VARCHAR',
                "constraint"=>255,
                "null"=>true
            ],

            "designation"=>[
                "type"=>'VARCHAR',
                "constraint"=>255,
                "null"=>true
            ],
            
            "contact"=>[
                "type"=>'VARCHAR',
                "constraint"=>255,
                "null"=>true,
                "unique"=>true,
            ],


            "status"=>[
                "type"=>'ENUM',
                "constraint"=>['0','1'],
                "default"=>"1",
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
      
        $this->forge->createTable('contacts');
    }

    public function down()
    {
        $this->forge->dropTable('contacts');
    }
}
