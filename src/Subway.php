<?php
declare(strict_types=1);

namespace Shigaayano\Subway;

class Subway
{
    public function calculate(string $input): int
    {
        //$input = ルート(駅,距離ポイント....)|出発駅|到着駅
        $route = $this->getTargetRoute($input);

        preg_match_all('/\d+/', $route, $points);
        $allPoint = 0;
        foreach ($points[0] as $point) {
            $allPoint += (int)$point;
        }

        return $this->resolvePriceByDistancePoint($allPoint);
    }

    //出発駅 ~ 到着駅までのルートを取得する
    private function getTargetRoute(string $input): string
    {
        //$input = ルート(駅,距離ポイント....)|出発駅|到着駅
        $inputs = explode('|', $input);
        $allRoute = $inputs[0]; //ルート(駅,距離ポイント....)

        //todo　逆行でもできるようにする
        return strstr($allRoute, $this->getEndStation($input), true);
    }

    //出発駅を取得する
    private function getStartStation(string $input): string
    {
        //$input = ルート(駅,距離ポイント....)|出発駅|到着駅
        $inputs = explode('|', $input);

        return $inputs[1];
    }

    //到着駅を取得する
    private function getEndStation(string $input): string
    {
        //$input = ルート(駅,距離ポイント....)|出発駅|到着駅
        $inputs = explode('|', $input);

        return $inputs[2];
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
