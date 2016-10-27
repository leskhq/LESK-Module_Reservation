<?php namespace App\Modules\Reservation\Utils;

use App\Models\Setting;
use DB;
use Illuminate\Database\Schema\Blueprint;
use Schema;
use Sroutier\LESKModules\Contracts\ModuleMaintenanceInterface;
use Sroutier\LESKModules\Traits\MaintenanceTrait;

class ReservationMaintenance implements ModuleMaintenanceInterface
{

    use MaintenanceTrait;


    static public function initialize()
    {
        DB::transaction(function () {

            /////////////////////////////////////////////////
            // Build database or run migration.
//            self::buildDB();
//            self::migrate('reservation');

            /////////////////////////////////////////////////
            // Seed the database.
//            self::seed('reservation');


            //////////////////////////////////////////
            // Create permissions.
            $permUseReservation = self::createPermission(  'use-reservation',
                'Use the Reservation module',
                'Allows a user to use the Reservation module.');
            ///////////////////////////////////////
            // Register routes.
            $routeHome = self::createRoute( 'reservation.index',
                'reservation',
                'App\Modules\Reservation\Http\Controllers\ReservationController@index',
                $permUseReservation );

            ////////////////////////////////////
            // Create roles.
            self::createRole( 'reservation-users',
                'Reservation Users',
                'Users of the Reservation module.',
                [$permUseReservation->id] );

            ////////////////////////////////////
            // Create menu system for the module
            $menuToolsContainer = self::createMenu( 'tools-container', 'Tools', 10, 'fa fa-folder', 'home', true );
            self::createMenu( 'reservation.index', 'Reservation', 0, 'fa fa-file', $menuToolsContainer, false, $routeHome );
        }); // End of DB::transaction(....)
    }


    static public function unInitialize()
    {
        DB::transaction(function () {

            self::destroyMenu('reservation.index');
            self::destroyMenu('tools-container');

            self::destroyRole('reservation-users');

            self::destroyRoute('reservation.index');

            self::destroyPermission('use-reservation');

            /////////////////////////////////////////////////
            // Destroy database or rollback migration.
//            self::rollbackMigration('reservation');
//            self::destroyDB();

        }); // End of DB::transaction(....)
    }


    static public function enable()
    {
        DB::transaction(function () {
            self::enableMenu('reservation.index');
        });
    }


    static public function disable()
    {
        DB::transaction(function () {
            self::disableMenu('reservation.index');
        });
    }


    static public function buildDB()
    {
        // Add code to build database and tables as needed.
    }


    static public function destroyDB()
    {
        // Add code to destroy database and tables as needed.
    }

}