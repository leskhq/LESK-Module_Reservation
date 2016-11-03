<?php
namespace App\Modules\Reservation\Database\Seeds;

use App\Modules\Reservation\Models\Item;
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

        $itemOperationLoaner = Item::create([
            'name' => 'Operation loaner laptop',
            'description' => 'Windows laptop with 4GB of RAM.',
            'available' => true]);

        $itemEngDevSrv02 = Item::create([
            'name' => 'Engineering DEV server 02',
            'description' => 'RAM:4GB, HDD:120GB',
            'available' => false]);

        $itemEngDevSrv02->reservations()->create([
            'user_id'       => \Auth::user()->id,
            'reason'        => 'Testing',
            'from_date'     => '2016-06-18',
            'to_date'       => '2016-06-20',
            'return_date'   => '2016-06-21' ]);

        $itemEngDevSrv02->reservations()->create([
            'user_id'   => \Auth::user()->id,
            'reason'    => 'More Testing',
            'from_date' => '2016-06-22',
            'to_date'   => '2016-06-25']);


        Model::reguard();

	}

}
