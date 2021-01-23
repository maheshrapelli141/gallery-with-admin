<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
	public function up()
	{
		$this->forge->addField([
      'id'          => [
              'type'           => 'INT',
              'unsigned'       => TRUE,
              'auto_increment' => TRUE
      ],
      'name'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '50',
      ],
      'created_at'       => [
          'type'           => 'DATETIME',
          // 'default'        => 'current_timestamp()',
      ],
      'updated_at'       => [
          'type'           => 'DATETIME',
          // 'default'        => 'current_timestamp()',
      ],
      'deleted_at'       => [
        'type'           => 'DATETIME',
        // 'default'        => 'current_timestamp()',
      ]
      ]);
    $this->forge->addKey('id', TRUE);
    $this->forge->createTable('categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('categories');
	}
}
