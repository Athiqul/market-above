<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InterestServices extends Migration
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
            "meeting_id"=>[
                "type"=>'INT',
                "constraint"=>10,
                "unsigned"=>true,
            ],

            "company_id"=>[
                "type"=>'INT',
                "constraint"=>8,
                "unsigned"=>true,
            ],

            "services_id"=>[
                "type"=>'INT',
                "constraint"=>4,
                "unsigned"=>true,
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
        $this->forge->addForeignKey('meeting_id','meeting_report','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('company_id','customers','id');
        $this->forge->addForeignKey('services_id','services','id','CASCADE','CASCADE');
        $this->forge->createTable('interest_services');
    }

    public function down()
    {
        $this->forge->dropTable('interest_services');
    }
}
