<?php namespace App\Modules\Reservation\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mod_rsrvtn_reservations';

    /**
     * Fields that can be  massed assigned.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'item_id', 'reason', 'from_date', 'to_date', 'return_date'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'from_date',
        'to_date',
        'return_date',
    ];

    public function item()
    {
        return $this->belongsTo('App\Modules\Reservation\Models\Item');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}