<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
class TeamTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) { 
	    	Team::create([
	            'name' => $this->quickRandom(),
	        ]);
    	}
    }
    public static function quickRandom($length = 16)
	{
	    $pool = 'hijklmnopqrstuvwxyz';

	    return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}
}
