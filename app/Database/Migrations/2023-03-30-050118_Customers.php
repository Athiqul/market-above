<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
{
    public function up()
    {
        $this->forge->addField([

            "id"=>[
                "type"=>'INT',
                "constraint"=>8,
                "unsigned"=>true,
                "auto_increment"=>true
            ],
            "user_id"=>[
                "type"=>'INT',
                "constraint"=>5,
                "unsigned"=>true,
            ],
          
            "company_name"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,
                "null"=>false
            ],
            "email"=>[
                "type"=>"VARCHAR",
                "constraint"=>100,
                "unique"=> true,
                'null'=>true

            ],
            "mobile"=>[
                "type"=>"VARCHAR",
                "constraint"=>11,
                "unique"=> true,
            ],
            "division"=>[
                "type"=>"VARCHAR",
                "constraint"=>128,
            ],
            "district"=>[
                "type"=>"VARCHAR",
                "constraint"=>128,
            ],

            "thana"=>[
                "type"=>"VARCHAR",
                "constraint"=>128,
            ], 
            "area"=>[
                "type"=>"VARCHAR",
                "constraint"=>128,
            ],
            "address"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,
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
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
