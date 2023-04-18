<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssignTask extends Migration
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
            "to_id"=>[
                "type"=>'INT',
                "constraint"=>5,
                "unsigned"=>true,
            ],

            "msg"=>[
                "type"=>'TEXT',
                "null"=>true,
            ],

            "job_date"=>[
                "type"=>'DATE',
                "null"=>true,
            ],
            "noti"=>[
                "type"=>'ENUM',
                "constraint"=>['0','1'],
                "default"=>'0',
            ],
            "complete"=>[
                "type"=>'ENUM',
                "constraint"=>['0','1'],
                "default"=>'0',
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
        $this->forge->addForeignKey('to_id','user_access','id','CASCADE','CASCADE');
        $this->forge->createTable('assign_task');
    }

    public function down()
    {
        $this->forge->dropTable('assign_task');
    }
}
