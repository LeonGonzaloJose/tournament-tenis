<?php

namespace Database\Seeders;

use App\Helpers\Helper;
use App\Models\PlayerModel;
use App\Models\PlayerStatsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $players = [
            ['name' => 'Juan', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'Carlos', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'Pedro', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'Luis', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'Jorge', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'Fernando', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'Miguel', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'Roberto', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'Ricardo', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'Francisco', 'age' => rand(18, 70), 'sex' => 'M', 'level' => rand(0, 100)],
            ['name' => 'María', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)],
            ['name' => 'Laura', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)],
            ['name' => 'Ana', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)],
            ['name' => 'Marta', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)],
            ['name' => 'Sofía', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)],
            ['name' => 'Isabel', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)],
            ['name' => 'Lucía', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)],
            ['name' => 'Elena', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)],
            ['name' => 'Paula', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)],
            ['name' => 'Clara', 'age' => rand(18, 70), 'sex' => 'F', 'level' => rand(0, 100)]
        ];
        
        foreach ($players as $value) {
            try {
                DB::beginTransaction();

                $stats = Helper::generateStats($value['level']);
                
                $player = PlayerModel::create($value);
                $stats["player_id"] = $player->id;
    
                PlayerStatsModel::create($stats);
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }


    }
}
