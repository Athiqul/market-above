<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyGeo extends Migration
{
    public function up()
    {
        
       
$this->forge->modifycolumn('divisions', array(
    'div_id' => array(
        'name' => 'id',
        'type' => 'INT',
        'constraint' => 2,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
    )
));
$this->forge->modifycolumn('districts', array(
    'dis_id' => array(
        'name' => 'id',
        'type' => 'INT',
        'constraint' => 3,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
    )
));
$this->forge->modifycolumn('thana', array(
    'thana_id' => array(
        'name' => 'id',
        'type' => 'INT',
        'constraint' => 4,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
    )
));
$this->forge->modifycolumn('unions', array(
    'uni_id' => array(
        'name' => 'id',
        'type' => 'INT',
        'constraint' => 6,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
    )
));

    }

    public function down()
    {
        //
    }
}
