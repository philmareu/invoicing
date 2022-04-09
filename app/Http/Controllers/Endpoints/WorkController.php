<?php

namespace App\Http\Controllers\Endpoints;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Http\Resources\WorkResource;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return WorkResource::collection(
            Work::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return WorkResource
     */
    public function store(StoreWorkRequest $request)
    {
        return WorkResource::make(
            Work::create(
                $request->validated()
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return WorkResource
     */
    public function show(Work $work)
    {
        return WorkResource::make(
            $work
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return WorkResource
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        $work->update(
            $request->validated()
        );

        return WorkResource::make(
            $work
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Work $work)
    {
        $work->delete();

        return response()->json(['Deleted.']);
    }
}
