<?php 

namespace App\Traits;

use Carbon\Carbon;

trait ReportTrait
{
    private function getFromDate() 
    {
        $request = \request();
        $paramDate = $request->get('d');
        $array = [
            '2d' => Carbon::now()->subDays(1),
            '1w' => Carbon::now()->subDays(7),
            '2w' => Carbon::now()->subDays(14),
            '1m' => Carbon::now()->subDays(30),
            '3m' => Carbon::now()->subDays(60),
            '6m' => Carbon::now()->subDays(180),
            '1y' => Carbon::now()->subDays(360),
        ];

        return $array[$paramDate] ?? null;
    }
}