<?php

namespace App\Http\Controllers;

use App\Channel;
use App\customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Excel;


class CustomerController extends Controller
{
    private $excle;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('customer.index', ['channels'=>Channel::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        //
    }

    public function search(Request $request) {

    }

    public function customersExport() {
        return $this->excel->download(new CustomersExport('customers1'), 'customers.xlsx');
//        (new InvoicesExport)->download('invoices.xlsx');
//        Excel::download(new CustomersExport(), 'customers.xlsx');

//        $customers = User::all();
//        Excel::create('customers', function($excel) use($customers) {
//            $excel->sheet('Sheet 1', function($sheet) use($customers) {
//                $sheet->fromArray($customers);
//            });
//        })->export('xls');
    }


}

    class CustomersExport implements FromView
    {
        private $customers;

        /**
         * CustomersExport constructor.
         * @param $customers
         */
        public function __construct($customers)
        {
            $this->customers = $customers;
        }


        public function view(): View
        {
            return view('customer.table', [
                'customers' => $this->customers
            ]);
        }
    }