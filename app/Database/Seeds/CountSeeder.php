<?php

namespace App\Database\Seeds;

class CountSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $data = [
      'id' => 1,
      'count' => 1
    ];

    // Using Query Builder
    $this->db->table('counter')->insert($data);
  }
}
