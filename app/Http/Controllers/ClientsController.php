<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientDestroyRequest;
use App\Models\ClientPhones;
use App\Models\Clients;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Validation\ValidationException;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Clients::orderBy('id', 'desc')->simplePaginate(100);
        return view('clients.index', [
            'models' => $models
        ]);

//        select c.id, c.pass_id, c.name, string_agg(cp.phone::text, ',') as phones from "clients" as c
//inner join client_phones as cp on cp.client_id=c.id
//group by c.id
//limit 101 offset 1000
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clients $clients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientDestroyRequest $request): ?RedirectResponse
    {
        if ($request->validated()) {
            $id = $request->get('id');
            Clients::destroy($id);
            return redirect()->to($request->header('referer'))->with('status', 'Client Delete Successfully');
        }
        throw new InvalidArgumentException();
    }
}
