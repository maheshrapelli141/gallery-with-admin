<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Topic extends Migration
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
      'description'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '1500',
      ],
      'images' => [
        'type'           => 'VARCHAR',
        'constraint'     => '5000',
      ],
      'category_id'          => [
        'type'           => 'INT',
        'unsigned'       => TRUE
      ],
      'created_at'       => [
          'type'           => 'DATETIME',
          // 'default'        => 'current_timestamp()',
      ],
      'updated_at'       => [
          'type'           => 'DATETIME',
          // 'default'        => 'current_timestamp()',
      ]
      ]);
    $this->forge->addForeignKey('category_id', 'categories','id');
    $this->forge->addKey('id', TRUE);
    $this->forge->createTable('topics');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('topics');
	}
}
