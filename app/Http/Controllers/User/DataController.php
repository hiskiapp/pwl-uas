<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Group;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Schedule;
use App\Models\Whatsapp;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function transactions(): JsonResponse
    {
        $invoices = Transaction::with('paymentMethod')
        ->where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

        return DataTables::of($invoices)
        ->editColumn('created_at', function ($invoice) {
            return $invoice->created_at ? with(new Carbon($invoice->created_at))->addDays()->isoFormat('D MMMM Y HH:mm') : '';
        })
        ->addIndexColumn()
        ->make();
    }
}
