<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserInfo extends Migration
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
            "user_id"=>[
                "type"=>'INT',
                "constraint"=>5,
                "unsigned"=>true,
            ],
          
            "image_link"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,
                "null"=>true
            ],
            "resume_link"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,
                "null"=>true
            ],
            "nid"=>[
                "type"=>"VARCHAR",
                "constraint"=>20,
                "unique"=> true,
                'null'=>true

            ],
            "desg"=>[
                "type"=>"VARCHAR",
                "constraint"=>50,
                "null"=>true
            ],
            "sex"=>[
                "type"=>"ENUM",
                "constraint"=>['0','1','2'],
                "null"=>true
            ],
            "dob"=>[
                "type"=>"DATETIME",
                "null"=>true
            ],
            "about"=>[
                "type"=>"TEXT",
                "null"=>true
            ],
            "division"=>[
                "type"=>"VARCHAR",
                "constraint"=>64,
                "null"=>true
            ],
            "district"=>[
                "type"=>"VARCHAR",
                "constraint"=>64,
                "null"=>true
            ],

            "thana"=>[
                "type"=>"VARCHAR",
                "constraint"=>64,
                "null"=>true
            ], 
            "area"=>[
                "type"=>"VARCHAR",
                "constraint"=>64,
                "null"=>true
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
        $this->forge->createTable('user_info');
    }

    public function down()
    {
       $this->forge->dropTable('user_info');
    }
}
