<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Districts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "dis_id"=>[
                "type"=>"INT",
                "constraint"=>10,
                "unsigned"=>true,
                "auto_increment"=>true,

            ],
            "div_id"=>[
                "type"=>"INT",
                "constraint"=>5,
                "unsigned"=>true,
            ],
            "en_name"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,

            ],
             "bn_name"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,

            ],
            "lat"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,

            ],
            "lot"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,

            ],
            "website"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,

            ],
        ]

        );
        $this->forge->addPrimaryKey("dis_id");
        $this->forge->addForeignKey('div_id','divisions','div_id','CASCADE','CASCADE');
        $this->forge->createTable('districts');
    }

    public function down()
    {
        $this->forge->dropTable('districts');
    }
}
