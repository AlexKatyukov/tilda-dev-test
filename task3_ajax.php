<?php

const CITIES_DICTIONARY = [
    ['name' => 'Москва', 'latitude' => 55.7522, 'longitude' => 37.6156, 'tel' => '8-495-9879879'],
    ['name' => 'Сочи', 'latitude' => 43.5992, 'longitude' => 39.7257, 'tel' => '8-8622-789789'],
];
const EARTH_RADIUS = 6372795;

/**
 * @see https://www.kobzarev.com/programming/calculation-of-distances-between-cities-on-their-coordinates/
 * @see http://gis-lab.info/qa/great-circles.html
 */
function calculateTheDistance(float $lat1Degrees, float $lon1Degrees, float $lat2Degrees, float $lon2Degrees)
{
    // перевести координаты в радианы
    $lat1 = $lat1Degrees * M_PI / 180;
    $lat2 = $lon1Degrees * M_PI / 180;
    $long1 = $lat2Degrees * M_PI / 180;
    $long2 = $lon2Degrees * M_PI / 180;
      
    // косинусы и синусы широт и разницы долгот
    $cl1 = cos($lat1);
    $cl2 = cos($lat2);
    $sl1 = sin($lat1);
    $sl2 = sin($lat2);
    $delta = $long2 - $long1;
    $cdelta = cos($delta);
    $sdelta = sin($delta);
      
    // вычисления длины большого круга
    $y = sqrt(pow($cl2 * $sdelta, 2) + pow($cl1 * $sl2 - $sl1 * $cl2 * $cdelta, 2));
    $x = $sl1 * $sl2 + $cl1 * $cl2 * $cdelta;
      
    $ad = atan2($y, $x);
    $dist = $ad * EARTH_RADIUS;
      
    return $dist;
}

if (isset($_GET['coord'])) {
    [$userLat, $userLon] = explode(',', $_GET['coord']);
    foreach (CITIES_DICTIONARY as $cityId => $city) {
        $cityDistance = calculateTheDistance($userLat, $userLon, $city['latitude'], $city['longitude']);
        if ($minDistance === null || $cityDistance < $minDistance) {
            $closestCityId = $cityId;
            $minDistance = $cityDistance;
        }
    }
    echo CITIES_DICTIONARY[$closestCityId]['tel'];
} else {
    echo CITIES_DICTIONARY[0]['tel'];
}