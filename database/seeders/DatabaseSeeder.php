<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            SawWeightSeeder::class,
            SawCriteriaScoreSeeder::class,
            RbfRuleSeeder::class,
            WashingStepSeeder::class,
            DetergentSeeder::class,
            CareTipSeeder::class,
            SymbolSeeder::class,
            AppSettingSeeder::class,
            FaqSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
