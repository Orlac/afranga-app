<?php

namespace App\Http\Controllers;

use App\Dto\ClientsExportDto;
use App\Exports\ClientsExport;
use App\Filters\ClientsFilter;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientFindRequest;
use App\Http\Requests\ClientsFilterExportRequest;
use App\Http\Requests\ClientsFilterRequest;
use App\Http\Requests\ClientStoreRequest;
use App\Jobs\ClientsExcelExportJob;
use App\Models\ClientPhones;
use App\Models\Clients;
use Illuminate\Http\RedirectResponse;
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientCreateRequest $request): RedirectResponse
    {
        Clients::create($request->validated());
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientFindRequest $request)
    {
        $client = $request->getClient() ?? abort(404);
        return view('clients.show', [
            'model' => $client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientFindRequest $request)
    {
        $client = $request->getClient() ?? abort(404);
        return view('clients.edit', [
            'model' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientFindRequest $request, ClientStoreRequest $csRequest, Clients $clients): RedirectResponse
    {
        $client = $request->getClient() ?? abort(404);
        $client->update($csRequest->validated());
        return redirect()->route('clients.index')->with('status', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientFindRequest $request): ?RedirectResponse
    {
        $client = $request->getClient() ?? abort(404);
        $client->delete();
        return redirect()->route('clients.index')->with('status', 'Destroyed Successfully');
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
