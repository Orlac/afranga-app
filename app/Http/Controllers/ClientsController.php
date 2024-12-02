<?php

namespace App\Http\Controllers;

use App\Dto\ClientsExportDto;
use App\Exports\ClientsExport;
use App\Filters\ClientsFilter;
use App\Http\Requests\ClientDestroyRequest;
use App\Http\Requests\ClientsFilterExportRequest;
use App\Http\Requests\ClientsFilterRequest;
use App\Jobs\ClientsExcelExportJob;
use App\Models\ClientPhones;
use App\Models\Clients;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ClientsFilterRequest $request): View
    {
        $filterDto = new ClientsExportDto(...$request->validated());
        $clientsFilter = new ClientsFilter($filterDto);
        $models = $clientsFilter->apply(Clients::query(), $request->validated())->simplePaginate(100);
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
        return back();
    }

    /**
     * @param ClientsFilterRequest $request
     * @return BinaryFileResponse|View
     */
    public function export(ClientsFilterRequest $request): BinaryFileResponse|View
    {
        $filterDto = new ClientsExportDto(...$request->validated());
        $clientsFilter = new ClientsFilter($filterDto);
        $builder = $clientsFilter->apply(Clients::query());
        if ($builder->count() > 10000) {
            return view('clients.export_lazy', [
                'request' => $request,
            ]);
        } else {
            return Excel::download(new ClientsExport($builder), 'clients.xlsx');
        }
    }

    public function exportLazy(ClientsFilterExportRequest $request): ?RedirectResponse
    {
        $filterDto = new ClientsExportDto(...$request->validated());
        ClientsExcelExportJob::dispatch($filterDto);
        return redirect()->route('clients.index')->with('status', 'Mail Sent Successfully');
    }
}
