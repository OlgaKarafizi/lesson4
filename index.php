<?php

//=========================реализация кэширования================================================
require_once "read_cache.php"; // Пытаемся вывести содержимое кэша
// Здесь идёт обычная генерация страницы
require_once "write_cache.php"; // Здесь идёт сохранение сгенерированной страницы в кэш
//================================================================================================

$url = "http://api.openweathermap.org/data/2.5/weather?lat=60&lon=30&APPID=65fad97980ae2cbbabc592fcb981364b"; //1 вариант по ссылке
//$file = 'weather.json'; //2 вариант из файла

$content = file_get_contents($url); //1 вариант по ссылке
//$content = file_get_contents($file); //2 вариант из файла

$result = json_decode($content, true);

//echo '<pre>';
//print_r($result);

$cod = $result['weather'][0]['icon'];
$tem = $result['main']['temp'];
$wind = $result['wind']['speed'];
$clouds = $result['clouds']['all'];
?>

<table>
    <tr>
        <td>Текущая погода в СПб</td>
        <td> <img src=<?php echo "http://openweathermap.org/img/w/$cod.png"; ?> alt="погода"> </td>
    </tr>
    <tr>
        <td>Температура</td>
        <td> <?= $tem - 273 ?> °С</td>
    </tr>
    <tr>
        <td>Ветер</td>
        <td> <?= $wind ?> м/с </td>
    </tr>
    <tr>
        <td>Облака</td>
        <td> <?= ($clouds <= 70) ? "Ясно" : "Облачно";
         ?> </td>
    </tr>
</table>