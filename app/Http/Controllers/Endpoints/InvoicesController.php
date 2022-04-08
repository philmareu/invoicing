<?php

namespace App\Http\Controllers\Endpoints;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return InvoiceResource::collection(
            Invoice::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return InvoiceResource
     */
    public function store(StoreInvoiceRequest $request)
    {
        return InvoiceResource::make(
            Invoice::create(
                $request->validated()
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return InvoiceResource
     */
    public function show(Invoice $invoice)
    {
        return InvoiceResource::make(
            $invoice
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return InvoiceResource
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update(
            $request->validated()
        );

        return InvoiceResource::make(
            $invoice
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(['Invoice deleted.']);
    }
}
