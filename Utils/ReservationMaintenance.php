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
            self::buildDB();

            /////////////////////////////////////////////////
            // Seed the database.
            self::seed('reservation');

            //////////////////////////////////////////
            // Create permissions.
            $permReservationSeeIndex = self::createPermission(  'reservation.see-index',
                'Reservation: See item list',
                'Allows a user to see the Reservation module item list.');
            $permReservationSeeItem = self::createPermission(  'reservation.see-item',
                'Reservation: See item details',
                'Allows a user to see the Reservation module item details.');
            $permReservationSignIn = self::createPermission(  'reservation.sign-in',
                'Reservation: Sign-in item',
                'Allows a user to sign-in an item of the Reservation module.');
            $permReservationSignOut = self::createPermission(  'reservation.sign-out',
                'Reservation: Sign-out item',
                'Allows a user to sign-out an item of the Reservation module.');
            $permReservationCreateItem = self::createPermission(  'reservation.create-item',
                'Reservation: Create a new item',
                'Allows a user to create a new item in the Reservation module.');
            $permReservationEditItem = self::createPermission(  'reservation.edit-item',
                'Reservation: Edit an existing item',
                'Allows a user to edit an existing item in the Reservation module.');
            $permReservationDeleteItem = self::createPermission(  'reservation.delete-item',
                'Reservation: Delete an existing item',
                'Allows a user to delete an existing item in the Reservation module.');

            ///////////////////////////////////////
            // Register routes.
            $routeHome = self::createRoute( 'reservation.index',
                'reservation',
                'App\Modules\Reservation\Http\Controllers\ReservationController@index',
                $permReservationSeeIndex );
            $routeShow = self::createRoute( 'reservation.show',
                'reservation/{itemID}',
                'App\Modules\Reservation\Http\Controllers\ReservationController@show',
                $permReservationSeeItem );
            $routeGetModalSignIn = self::createRoute( 'reservation.confirm-sign-in',
                'reservation/{itemID}/confirm-sign-in',
                'App\Modules\Reservation\Http\Controllers\ReservationController@getModalSignIn',
                $permReservationSignIn );
            $routeSignIn = self::createRoute( 'reservation.sign-in',
                'reservation/{itemID}/sign-in',
                'App\Modules\Reservation\Http\Controllers\ReservationController@signIn',
                $permReservationSignIn );
            $routeGetSignOut = self::createRoute( 'reservation.sign-out',
                'reservation/{itemID}/sign-out',
                'App\Modules\Reservation\Http\Controllers\ReservationController@getSignOut',
                $permReservationSignOut );
            $routePostSignOut = self::createRoute( 'reservation.post-sign-out',
                'reservation/{itemID}/sign-out',
                'App\Modules\Reservation\Http\Controllers\ReservationController@postSignOut',
                $permReservationSignOut,
                'POST' );
            $routeCreate = self::createRoute( 'reservation.create',
                'reservation/create',
                'App\Modules\Reservation\Http\Controllers\ReservationController@create',
                $permReservationCreateItem );
            $routeStore = self::createRoute( 'reservation.store',
                'reservation/',
                'App\Modules\Reservation\Http\Controllers\ReservationController@store',
                $permReservationCreateItem,
                'POST' );
            $routeEdit = self::createRoute( 'reservation.edit',
                'reservation/{itemID}/edit',
                'App\Modules\Reservation\Http\Controllers\ReservationController@edit',
                $permReservationEditItem );
            $routeUpdate = self::createRoute( 'reservation.patch',
                'reservation/{itemID}',
                'App\Modules\Reservation\Http\Controllers\ReservationController@update',
                $permReservationEditItem,
                'PATCH' );
            $routeGetModalDeleteItem = self::createRoute( 'reservation.confirm-delete-item',
                'reservation/{itemID}/confirm-delete',
                'App\Modules\Reservation\Http\Controllers\ReservationController@getModalDeleteItem',
                $permReservationDeleteItem );
            $routeDestroyItem = self::createRoute( 'reservation.delete',
                'reservation/{itemID}/delete',
                'App\Modules\Reservation\Http\Controllers\ReservationController@destroyItem',
                $permReservationDeleteItem );

            ////////////////////////////////////
            // Create roles.
            self::createRole( 'reservation-users',
                'Reservation users',
                'Regular users of the Reservation module.',
                [
                    $permReservationSeeIndex->id,
                    $permReservationSeeItem->id,
                    $permReservationSignIn->id,
                    $permReservationSignOut->id,
                ] );
            self::createRole( 'reservation-power-users',
                'Reservation power users',
                'Power users of the Reservation module.',
                [
                    $permReservationSeeIndex->id,
                    $permReservationSeeItem->id,
                    $permReservationSignIn->id,
                    $permReservationSignOut->id,
                    $permReservationCreateItem->id,
                    $permReservationEditItem->id,
                ] );
            self::createRole( 'reservation-admins',
                'Reservation administrators',
                'Administrators of the Reservation module.',
                [
                    $permReservationSeeIndex->id,
                    $permReservationSeeItem->id,
                    $permReservationSignIn->id,
                    $permReservationSignOut->id,
                    $permReservationCreateItem->id,
                    $permReservationEditItem->id,
                    $permReservationDeleteItem->id,
                ] );

            ////////////////////////////////////
            // Create menu system for the module
            $menuToolsContainer = self::createMenu( 'tools-container', 'Tools', 10, 'ion ion-settings', 'home', true );
            self::createMenu( 'reservation.index', 'Reservation', 0, 'fa fa-file', $menuToolsContainer, false, $routeHome );
        }); // End of DB::transaction(....)
    }


    static public function unInitialize()
    {
        DB::transaction(function () {

            self::destroyMenu('reservation.index');
            self::destroyMenu('tools-container');

            self::destroyRole('reservation-admins');
            self::destroyRole('reservation-power-users');
            self::destroyRole('reservation-users');

            self::destroyRoute('reservation.delete');
            self::destroyRoute('reservation.confirm-delete-item');
            self::destroyRoute('reservation.patch');
            self::destroyRoute('reservation.edit');
            self::destroyRoute('reservation.store');
            self::destroyRoute('reservation.create');
            self::destroyRoute('reservation.post-sign-out');
            self::destroyRoute('reservation.sign-out');
            self::destroyRoute('reservation.sign-in');
            self::destroyRoute('reservation.confirm-sign-in');
            self::destroyRoute('reservation.show');
            self::destroyRoute('reservation.index');

            self::destroyPermission('reservation.delete-item');
            self::destroyPermission('reservation.edit-item');
            self::destroyPermission('reservation.create-item');
            self::destroyPermission('reservation.sign-out');
            self::destroyPermission('reservation.sign-in');
            self::destroyPermission('reservation.see-item');
            self::destroyPermission('reservation.see-index');

            /////////////////////////////////////////////////
            // Destroy database or rollback migration.
            self::destroyDB();

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
        Schema::create('mod_rsrvtn_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->longText('description');
            $table->boolean('available')->default(true);
            $table->timestamps();
        });

        Schema::create('mod_rsrvtn_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('item_id');
            $table->string('reason');
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->dateTime('return_date')->nullable();
            $table->timestamps();
        });

    }


    static public function destroyDB()
    {
        Schema::dropIfExists('mod_rsrvtn_items');
        Schema::dropIfExists('mod_rsrvtn_reservations');

    }

}