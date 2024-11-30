<?php

namespace App\Http\Controllers;

use App\Exports\ClientsExport;
use App\Filters\ClientsFilter;
use App\Http\Requests\ClientDestroyRequest;
use App\Http\Requests\ClientsExportRequest;
use App\Http\Requests\ClientsFilterRequest;
use App\Models\ClientPhones;
use App\Models\Clients;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ClientsFilterRequest $request, ClientsFilter $clientsFilter)
    {
        $models = $clientsFilter->apply(Clients::query(), $request)->simplePaginate(100);
        return view('clients.index', [
            'models' => $models,
            'request' => $request,
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
        $id = $request->get('id');
        Clients::destroy($id);
        return redirect()->to($request->header('referer'))->with('status', 'Client Delete Successfully');
    }

    public function test()
    {
        return '555555555555555555';
    }

    /**
     * @param ClientsExportRequest $request
     * @return BinaryFileResponse|null
     */
    public function export(ClientsExportRequest $request): ?BinaryFileResponse
    {
        set_time_limit(-1);
        return Excel::download(new ClientsExport($request), 'clients.xlsx');
//        return '1111111111111111111111111111111111';
//        echo 3; exit;
//        $vals = $request->validated();
//        print_r($vals);
//        if ($request->validated()) {
//            echo 1 ;
//            exit;
////            return Excel::download(new ClientsExport(), 'clients.xlsx');
//        } else {
////            print_r($request->err)
//            echo 2 ;
//            exit;
//        }
//        return '';
//        throw new InvalidArgumentException();
    }
}
