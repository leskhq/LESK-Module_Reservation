<?php namespace App\Modules\Reservation\Repositories\Criteria\Item;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class ItemsByNamesAscending extends Criteria {


    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply( $model, Repository $repository )
    {
        $model = $model->orderBy('name', 'ASC');
        return $model;
    }

}
