<?php

namespace App\Http\Controllers\Endpoints;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CustomerResource::collection(
            Customer::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CustomerResource
     */
    public function store(StoreCustomerRequest $request)
    {
        return CustomerResource::make(
            Customer::create(
                $request->all()
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CustomerResource
     */
    public function show(Customer $customer)
    {
        return CustomerResource::make(
            $customer
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Customer
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer
            ->update($request->validated());

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['Customer deleted.']);
    }
}
