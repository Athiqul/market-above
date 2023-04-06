<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Thana extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "thana_id"=>[
                "type"=>"INT",
                "constraint"=>10,
                "unsigned"=>true,
                "auto_increment"=>true,

            ],
            "dis_id"=>[
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
        $this->forge->addPrimaryKey("thana_id");
        $this->forge->addForeignKey('dis_id','districts','dis_id','CASCADE','CASCADE');
        $this->forge->createTable('thana');
    }

    public function down()
    {
        $this->forge->dropTable('thana');
    }
}
