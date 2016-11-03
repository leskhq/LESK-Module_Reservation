<?php namespace App\Modules\Reservation\Models;

use App\Modules\Reservation\Exceptions\ItemNotSignedInException;
use App\Modules\Reservation\Exceptions\ItemNotSignedOutException;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mod_rsrvtn_items';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'available'];

    public function reservations()
    {
        return $this->hasMany('App\Modules\Reservation\Models\Reservation');
    }

    public function latest_reservation()
    {
        $reservations = $this->reservations()->orderBy('id', 'desc')->limit(1)->get();
        $latestRes = $reservations->first();

        return $latestRes;
    }

    public function sign_in()
    {
        if (!$this->available) {
            $latestRes = $this->latest_reservation();
            $latestRes->return_date = date("Y-m-d H:i:s");
            $this->available = true;
            $latestRes->save();
            $this->save();
        } else {
            throw new ItemNotSignedOutException(trans('reservation::general.exceptions.item-not-signed-out', ['name' => $this->name]));
        }
    }

    public function sign_out($attributes)
    {
        if ($this->available) {
            $attributes['from_date'] = Carbon::createFromFormat('Y/m/d', $attributes['from_date']);
            $attributes['to_date'] = Carbon::createFromFormat('Y/m/d', $attributes['to_date']);

            $this->reservations()->create($attributes);
            $this->available = false;
            $this->save();
        } else {
            throw new ItemNotSignedInException(trans('reservation::general.exceptions.item-not-signed-in', ['name' => $this->name]));
        }

    }


}