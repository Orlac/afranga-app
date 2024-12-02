<?php

namespace App\Jobs;

use App\Dto\ClientsExportDto;
use App\Filters\ClientsFilter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ClientsExcelExportJob implements ShouldQueue
{
    use Queueable;

    /**
     * @var int
     */
    public $uniqueFor = 3600;

    private ?string $fileName = null;

    public  function __construct(private readonly ClientsExportDto $filterData)
    {
        $this->fileName = $this->getFileName();
    }

    /**
     */
    public function uniqueId(): string
    {
        return $this->getFileName();
    }

    /**
     * Execute the job.
     */
    public function handle(ClientsFilter $clientsFilter): void
    {
        print_r($this->filterData);
        echo date('Y-') . '_' . json_encode($this->filterData);
//        $st = time();
//        echo sprintf('[%s] start build file [%s]', date('H:i:s'), $this->fileName) . PHP_EOL;
//        $builder = $clientsFilter->apply(Clients::query(), $this->filterData);
//        Excel::store(new ClientsExport($builder), $this->fileName, 'public');
//        $et = time();
//        echo sprintf('[%s] completed (%s sec)', date('H:i:s'), $et - $st) . PHP_EOL;
    }

//    private function sendNotify(): void
//    {
//        $email = $this->filterData['email'];
//        $path =
//    }

    private function getFileName(): string
    {
        return date('Y-m-d-H-i-s') . '_' . md5(json_encode($this->filterData)) . '_clients.xlsx';
    }
}
