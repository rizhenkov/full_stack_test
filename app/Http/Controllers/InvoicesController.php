<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceCollection;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InvoiceCollection
     */
    public function index()
    {
        return new InvoiceCollection(Invoice::orderBy('id', 'desc')->paginate(10));
    }

    public function payPage($uri)
    {
        $invoice = Invoice::where('uri', $uri)->firstOrFail();

        return view('invoice', [
            'invoice' => $invoice
        ]);
    }

    public function pay($uri, Request $request)
    {
        $invoice = Invoice::where('uri', $uri)->firstOrFail();
        if($invoice->status){
            return redirect($invoice->link)->with('status', 'Invoice already payed!');
        }

        $invoice->payer = $request->input('payer');
        $invoice->status = true;
        $invoice->save();

        return redirect($invoice->link)->with('status', 'Invoice payed successful!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'school' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'email' => 'required|email:rfc,dns',
        ]);

        $validatedData['uri'] = $this->makeUniqueUri();

        $invoice = Invoice::create($validatedData);

        return $invoice;
    }

    protected function makeUniqueUri()
    {
        do
        {
            $uri = Str::random(30);
            $exists = Invoice::where('uri', $uri)->get();
        }
        while(!$exists->isEmpty());

        return $uri;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
