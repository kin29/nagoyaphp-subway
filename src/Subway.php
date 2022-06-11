<?php
declare(strict_types=1);

namespace Kin29\Subway;

class Subway
{
    public function calculate(string $input): int
    {
        $totalPoint = $this->getTotalPoint($input);

        return $this->resolvePriceByDistancePoint($totalPoint);
    }

    private function getTotalPoint(string $input): int
    {
        $pointList = $this->getRoutePointList($input);

        return $this->calculateTotalPoint($pointList);
    }

    private function getRoutePointList($input): array
    {
        //$input = ルート(駅,距離ポイント....)|出発駅|到着駅
        $inputs = explode('|', $input);
        [$route, $startStation, $endStation] = [$inputs[0], $inputs[1], $inputs[2]];

        //出発駅と到着駅どっちが先か確認する
        $startStationIndex = strpos($route, $startStation);
        $endStationIndex = strpos($route, $endStation);
        if ($startStationIndex < $endStationIndex) {
            $targetRoutes = strstr($route, $startStation);
            $targetRoutes = strstr($targetRoutes, $endStation, true);
            preg_match_all('/\d/', $targetRoutes, $pointList);

            return $pointList[0];
        }

        //逆行の場合
        $targetRoutes = strstr($route, $endStation);
        $targetRoutes = strstr($targetRoutes, $startStation, true);
        preg_match_all('/\d/', $targetRoutes, $pointList);

        return $pointList[0];
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
    private function resolvePriceByDistancePoint(int $distancePoint): int
    {
        return match ($distancePoint) {
            1 => 210,
            2 => 240,
            3 => 270,
            4 => 300,
        };
    }
}
