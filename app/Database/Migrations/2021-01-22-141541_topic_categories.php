<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TopicCategories extends Migration
{
	public function up()
	{
		$this->forge->addField([
      'topic_id'          => [
              'type'           => 'INT',
              'unsigned'       => TRUE,
      ],
      'category_id'          => [
        'type'           => 'INT',
        'unsigned'       => TRUE,
      ],
      'deleted_at'       => [
        'type'           => 'DATETIME',
        // 'default'        => 'current_timestamp()',
      ]
    ]);
    $this->forge->addForeignKey('topic_id', 'topics','id');
    $this->forge->addForeignKey('category_id', 'categories','id');
    $this->forge->createTable('topic_categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('topic_categories');
	}
}
