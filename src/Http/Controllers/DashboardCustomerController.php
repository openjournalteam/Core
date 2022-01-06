<?php

namespace OpenJournalTeam\Core\Http\Controllers;

use App\Modules\Shop\Models\Customer;
use App\Modules\Shop\Models\CustomerTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DashboardCustomerController extends BaseController
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect(route('core.customer.login'));
        }

        $data = [
            'customer' => Customer::where('email', Auth::user()->email)->first(),
            'open'     => CustomerTicket::STATUS_OPEN,
            'closed'   => CustomerTicket::STATUS_CLOSED
        ];

        add_module_style('shop/customer/css/customer_order.css');
        return render('core::pages.customer.index', $data);
    }

    public function ticketCreate(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'subject'     => 'required|string',
            'type'        => 'required|string',
            'priority'    => 'required|string',
            'comment'     => 'required|string'
        ]);

        CustomerTicket::updateOrCreate(
            [
                'customer_id' => $request->input('customer_id')
            ],
            [
                'subject'  => $request->input('subject'),
                'type'     => $request->input('type'),
                'priority' => $request->input('priority'),
                'comment'  => $request->input('comment'),
                'status'   => CustomerTicket::STATUS_OPEN
            ]
        );

        return response_success(['msg' => 'Ticket created..']);
    }

    public function ticketClosed(CustomerTicket $customerTicket)
    {
        $customerTicket->status = CustomerTicket::STATUS_CLOSED;
        $customerTicket->save();

        return response_success(['msg' => 'Ticket closed..']);
    }

    public function getStatusTicket()
    {
        $data = [
            'open'   => CustomerTicket::where('status', CustomerTicket::STATUS_OPEN)->count(),
            'closed' => CustomerTicket::where('status', CustomerTicket::STATUS_CLOSED)->count()
        ];
        
        return response_success($data);
    }

    public function ticketDatatable(Request $request, Customer $customer, $status)
    {
        if ($request->ajax()) {
            $data = $customer->tickets()->where('status', $status);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('subject', function ($row) {
                    $format = '<a href="%s">%s</a>';
                    $data = [
                        route('core.customer.ticket.detail', [$row->customer->token, $row->id]),
                        $row->subject,
                    ];

                    return vsprintf($format, $data);
                })
                ->editColumn('created_at', function ($row) {
                    $format = '<div class="row">%s | %s</div>';
                    $data = [
                        $row->created_at->format('d M Y'),
                        $row->updated_at->format('d M Y')
                    ];
                    
                    return vsprintf($format, $data);
                })
                ->editColumn('actions', function ($row) {
                    $json = json_encode([
                        'customer_id' => $row->customer->id,
                        'subject'     => $row->subject,
                        'type'        => $row->type,
                        'priority'    => $row->priority,
                        'comment'     => $row->comment,
                      ]);

                    return view('core::pages.customer.components.datatable.actions', compact('row', 'json'));
                })
                ->rawColumns(['actions', 'subject', 'created_at'])
                ->make(true);
        }
    }
}