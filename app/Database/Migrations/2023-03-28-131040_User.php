<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([

            "id"=>[
                "type"=>'INT',
                "constraint"=>5,
                "unsigned"=>true,
                "auto_increment"=>true
            ],
            "employ_id"=>[
                "type"=>'VARCHAR',
                "constraint"=>15,
            ],
            "name"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,
                "null"=>false
            ],
            "email"=>[
                "type"=>"VARCHAR",
                "constraint"=>100,
                "unique"=> true,
                "null"=>true

            ],
            "mobile"=>[
                "type"=>"VARCHAR",
                "constraint"=>11,
                "unique"=> true,
            ],
            "password"=>[
                "type"=>"VARCHAR",
                "constraint"=>128,
            ],
            "role"=>[
                "type"=>"ENUM",
                "constraint"=>['1','0'],
                "default"=>'1'
            ],

            "status"=>[
                "type"=>"ENUM",
                "constraint"=>['1','0'],
                "default"=>'1'
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
        $this->forge->addUniqueKey('employ_id');
        $this->forge->createTable('user_access');
    
    }

    public function down()
    {
        $this->forge->dropTable('user_access');
    }
}
