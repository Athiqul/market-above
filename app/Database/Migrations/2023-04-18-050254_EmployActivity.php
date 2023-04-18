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
            "user_id"=>[
                "type"=>'INT',
                "constraint"=>5,
                "unsigned"=>true,
            ],
            "task_id"=>[
                "type"=>'INT',
                "constraint"=>12,
                "unsigned"=>true,
                "null"=>true
            ],

            "meeting_id"=>[
                "type"=>'INT',
                "constraint"=>10,
                "unsigned"=>true,
                "null"=>true
            ],

            "company_id"=>[
                "type"=>'INT',
                "constraint"=>8,
                "unsigned"=>true,
                "null"=>true
            ],

            "type"=>[
                "type"=>'ENUM',
                "constraint"=>['0','1','2','3','4','5','6'],
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
        $this->forge->addForeignKey('task_id','assign_task','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('meeting_id','meeting_report','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('company_id','customers','id','CASCADE','CASCADE');
        $this->forge->createTable('employ_activity');
    }

    public function down()
    {
        $this->forge->dropTable('employ_activity');
    }
}
