<?php

namespace App\Jobs;

use App\Dto\ClientsExportDto;
use App\Exports\ClientsExport;
use App\Filters\ClientsFilter;
use App\Mail\ClientsExportMail;
use App\Models\Clients;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ClientsExcelExportJob implements ShouldQueue
{
    use Queueable;


    private ?string $fileName = null;

    public  function __construct(private readonly ClientsExportDto $filterDto)
    {
        $this->fileName = $this->getFileName();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        print_r($this->filterDto);
        $clientsFilter = new ClientsFilter($this->filterDto);
        $st = time();
        echo sprintf('[%s] start build file [%s]', date('H:i:s'), $this->fileName) . PHP_EOL;
        $builder = $clientsFilter->apply(Clients::query());
        echo sprintf('[%s] записей', $builder->count()) . PHP_EOL;
        Excel::store(new ClientsExport($builder), $this->fileName);
        $this->sendNotify();
        $et = time();
        echo sprintf('[%s] completed (%s sec)', date('H:i:s'), $et - $st) . PHP_EOL;
    }

    private function sendNotify(): void
    {
        Mail::to($this->filterDto->mail)->send(new ClientsExportMail($this->filterDto, $this->fileName));
    }

    private function getFileName(): string
    {
        return date('Y-m-d-H-i-s') . '_' . md5(json_encode($this->filterDto)) . '_clients.xlsx';
    }
}
