<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Comics extends Seeder
{
	public function run()
	{
		$comics_data = [
			[
				'title' => 'Boku No Hero',
				'slug'  => 'boku-no-hero',
				'author' => 'Arnold Therigan',
				'publisher' => 'Gramedia',
				'cover' => 'bokunohero.jpg'
			],
			[
				'title' => 'Shonen Jump',
				'slug'  => 'shonen-jump',
				'author' => 'Putri Therigan',
				'publisher' => 'Indo Book',
				'cover' => 'shonenjump.jpg'
			]
		];

		foreach ($comics_data as $data) {
			// insert semua data ke tabel
			$this->db->table('comics')->insert($data);
		}
	}
}
