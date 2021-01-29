<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Counter extends Migration
{
	public function up()
	{
    //
    $this->forge->addField([
      'id'          => [
        'type'           => 'INT',
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ],
      'count'          => [
        'type'           => 'INT',
        'unsigned'       => TRUE,
      ]
    ]);
    $this->forge->addKey('id', TRUE);
    $this->forge->createTable('counter');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('counter');
	}
}
