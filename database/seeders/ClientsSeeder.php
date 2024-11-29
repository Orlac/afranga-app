<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    private int $countClients = 100000;
    private int $countPhones = 5;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->delete();
        foreach ($this->getClients() as $item) {
            DB::table('clients')->insertOrIgnore($item[0]);
            DB::table('client_phones')->insertOrIgnore($item[1]);
        }
    }

    private function getClients(int $batchSize = 100): \Iterator
    {
        $start = 1;
        $clientsBatch = [];
        $phoneBatch = [];
        while ($start <= $this->countClients) {
            $clientsBatch[] = [
                'id' => $start,
                'name' => 'name_' . $start,
                'pass_id' => mt_rand(),
            ];
            $phoneBatch += array_merge($phoneBatch, $this->getPhones($start));
            if (count($clientsBatch) === $batchSize) {
                yield [$clientsBatch, $phoneBatch];
                $clientsBatch = [];
                $phoneBatch = [];
            }
            $start++;
        }
        if (count($clientsBatch) > 0) {
            yield [$clientsBatch, $phoneBatch];
        }
    }

    private function getPhones(int $clientId): array
    {
        $phoneBatch = [];
        $start = 1;
        while ($start <= $this->countPhones) {
            $phoneBatch[] = [
                'client_id' => $clientId,
                'phone' => '7' . mt_rand(9000000000, 9999999999),
            ];
            $start++;
        }
        return $phoneBatch;
    }
}
