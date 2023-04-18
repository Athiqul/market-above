<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MeetingReport extends Migration
{
    public function up()
    {
        $this->forge->addField([

            "id"=>[
                "type"=>'INT',
                "constraint"=>10,
                "unsigned"=>true,
                "auto_increment"=>true
            ],
            "user_id"=>[
                "type"=>'INT',
                "constraint"=>5,
                "unsigned"=>true,
            ],

            "company_id"=>[
                "type"=>'INT',
                "constraint"=>8,
                "unsigned"=>true,
            ],
           
            "contact_person"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,
                "null"=>true
            ],
            "desg"=>[
                "type"=>"VARCHAR",
                "constraint"=>50,
                "null"=>true
            ],
            "mobile"=>[
                "type"=>"VARCHAR",
                "constraint"=>15,
                "null"=>true
            ],
            "email"=>[
                "type"=>"VARCHAR",
                "constraint"=>100,
                "null"=>true
            ],
            "summary"=>[
                "type"=>"TEXT",
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
        $this->forge->addForeignKey('company_id','customers','id','CASCADE','CASCADE');
        $this->forge->createTable('meeting_report');
    }

    public function down()
    {
         $this->forge->dropTable('meeting_report');
    }
}
