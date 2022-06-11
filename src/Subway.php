<?php
declare(strict_types=1);

namespace Kin29\Subway;

class Subway
{
    public function calculate(string $input): int
    {
        $targetRoute = $this->getTargetRoute($input);
        preg_match_all('/\d/', $targetRoute, $pointLists);
        $totalPoint = $this->calculateTotalPoint($pointLists[0]);

        return $this->resolvePriceByPoint($totalPoint);
    }

    private function getTargetRoute(string $input): string
    {
        //$input = ルート(駅,距離ポイント....)|出発駅|到着駅
        $inputs = explode('|', $input);
        [$route, $startStation, $endStation] = [$inputs[0], $inputs[1], $inputs[2]];

        $startStationIndex = strpos($route, $startStation);
        $endStationIndex = strpos($route, $endStation);
        if ($startStationIndex < $endStationIndex) {
            return strstr(strstr($route, $startStation), $endStation, true);
        }

        //逆行の場合
        return strstr(strstr($route, $endStation), $startStation, true);
    }

    private function calculateTotalPoint($pointList): int
    {
        $totalPoint = 0;
        foreach ($pointList as $point) {
            $totalPoint += (int)$point;
        }

        return $totalPoint;
    }

    //料金表
    private function resolvePriceByPoint(int $distancePoint): int
    {
        return match ($distancePoint) {
            1 => 210,
            2 => 240,
            3 => 270,
            4 => 300,
        };
    }
}
