<?php

namespace App\Helpers;

class Helper{

    public static function generateStats(int $lvl){
        $stats = [0, 0, 0, 0];

        for ($i = 0; $i < $lvl; $i++) {
            $stats[array_rand($stats)]++;
        }

        $response = [
            'speed' => $stats[0],
            'strength' => $stats[1],
            'reflex' => $stats[2],
            'energy' => $stats[3]
        ];

        return $response;
    }
}
