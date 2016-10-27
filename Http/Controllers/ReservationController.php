<?php
namespace App\Modules\Reservation\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuditRepository as Audit;
use Auth;

class ReservationController extends Controller
{
    public function index()
    {
        Audit::log(Auth::user()->id, trans('reservation::general.audit-log.category'), trans('reservation::general.audit-log.msg-index'));

        $page_title = trans('reservation::general.page.index.title');
        $page_description = trans('reservation::general.page.index.description');

        return view('reservation::index', compact('page_title', 'page_description'));
    }

}
