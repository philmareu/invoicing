<?php

namespace App\Http\Controllers\Endpoints;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstallationsRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstallationsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstallationsRequest $request)
    {
        $user = User::make($request->only([
            'name',
            'email',
            'password'
        ]));

        $user->role()->associate(
            Role::where('slug', 'owner')->first()
        );

        $user->save();

        return response('Installation successful');
    }
}
