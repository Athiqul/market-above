<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Documents extends Migration
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
           
          

            "title"=>[
                "type"=>'VARCHAR',
                "constraint"=>255,
                "null"=>true
            ],

            "doc_link"=>[
                "type"=>'VARCHAR',
                "constraint"=>255,
                "null"=>true
            ],
            

            "type"=>[
                "type"=>'ENUM',
                "constraint"=>['0','1','2'],
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
      
        $this->forge->createTable('info');
    }

    public function down()
    {
        $this->forge->dropTable('info');
    }
}
