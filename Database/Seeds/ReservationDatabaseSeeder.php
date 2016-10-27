<?php
namespace App\Modules\Reservation\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ReservationDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\Reservation\Database\Seeds\FoobarTableSeeder');

        Model::reguard();

	}

}
