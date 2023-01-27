<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'title' => 'test',
            'body'    => 'testing.....',
            'slug' => 'test'
        ];

        $this->db->query('INSERT INTO posts (title, body, slug) VALUES(:title:, :body:, :slug:)', $data);

        $this->db->table('posts')->insert($data);
    }
}
