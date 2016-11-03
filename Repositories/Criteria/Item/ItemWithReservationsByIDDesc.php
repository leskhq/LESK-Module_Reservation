<?php namespace App\Modules\Reservation\Repositories\Criteria\Item;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class ItemWithReservationsByIDDesc extends Criteria {


    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->with(['reservations' => function ($query) {
            $query->orderBy('id', 'desc');
        }]);

        return $model;
    }

}
