<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Unions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "uni_id"=>[
                "type"=>"INT",
                "constraint"=>10,
                "unsigned"=>true,
                "auto_increment"=>true,

            ],
            "thana_id"=>[
                "type"=>"INT",
                "constraint"=>10,
                "unsigned"=>true,
            ],
            "en_name"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,

            ],
             "bn_name"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,

            ]
           
        ]

        );
        $this->forge->addPrimaryKey("uni_id");
        $this->forge->addForeignKey('thana_id','thana','thana_id','CASCADE','CASCADE');
        $this->forge->createTable('unions');
    }

    public function down()
    {
        $this->forge->dropTable('unions');
    }
}
