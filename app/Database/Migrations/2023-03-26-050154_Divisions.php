<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Divisions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "div_id"=>[
                "type"=>"INT",
                "constraint"=>5,
                "unsigned"=>true,
                "auto_increment"=>true,

            ],
            "en_name"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,

            ],
             "bn_name"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,

            ],
        ]

        );
        $this->forge->addPrimaryKey("div_id");
        $this->forge->createTable('divisions');
    }

    public function down()
    {
        $this->forge->dropTable('divisions');
    }
}
