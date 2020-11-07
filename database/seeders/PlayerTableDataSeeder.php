<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;
class PlayerTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) { 
	    	Player::create([
	            'teams_id' =>rand(1,5),
	            'first_name' => $this->quickRandom(),
	            'last_name' => $this->quickRandom(),
	        ]);
    	}
    }
    public static function quickRandom($length = 16)
	{
	    $pool = 'hijklmnopqrstuvwxyz';
	    return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}
	
}
