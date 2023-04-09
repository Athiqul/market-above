<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CompanyTableUpdate extends Migration
{
    public function up()
    {
        $fields=[
            "url"=>[
                "type"=>"VARCHAR",
                "constraint"=>255,
                "null"=>true,
            ],
            "company_desc"=>[
                "type"=>"TEXT",
                "null"=>true,
            ]
        ];
        $this->forge->addColumn('customers',$fields);
    }

    public function down()
    {
        $this->forge->dropColumn('customers',['url','company_desc']);
    }
}
