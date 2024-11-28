<?php

namespace Database\Seeders;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    private int $countClients = 1000000;
    private int $countPhones = 5;

    private ?Generator $fakeGenerator = null;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->fakeGenerator = Factory::create('ru_RU');
        DB::table('clients')->delete();
        foreach ($this->getClients() as $clients) {
            DB::table('clients')->insertOrIgnore($clients);
        }
    }

    private function getClients(int $batchSize = 1000): \Iterator
    {
        $start = 1;
        $clientsBatch = [];
        while ($start <= $this->countClients) {
            $clientsBatch[] = [
                'id' => $start,
                'name' => $this->fakeGenerator->name(),
                'pass_id' => mt_rand(),
                'created_at' => $this->fakeGenerator->dateTime(),
                'updated_at' => $this->fakeGenerator->dateTime(),
                'phones' => json_encode(array_map(
                    fn($vak) => (int) '7' . mt_rand(9000000000, 9999999999),
                    array_fill(0, $this->countPhones, null)
                )),
            ];
            if (count($clientsBatch) === $batchSize) {
                yield $clientsBatch;
                $clientsBatch = [];
            }
            $start++;
        }
        if (count($clientsBatch) > 0) {
            yield $clientsBatch;
        }
    }

}
