<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;
use App\Models\User;

class UserContractsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contracts_quantity = config('fridge.seed.contracts');
        Contract::factory()->count($contracts_quantity)->create()->each(
            function($contract) {
                $contract->user()->save(
                    User::factory()->create([
                        'contract_id' => $contract->id
                    ])
                );
            }
        );
    }
}
