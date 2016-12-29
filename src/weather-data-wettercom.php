<?php

$project = $wettercom_project;
$api_key = $wettercom_api_key;

$forecast_citycode = $wettercom_citycode;
$forecast_checksum = md5($project.$api_key.$forecast_citycode);
$forecast_url = 'http://api.wetter.com/forecast/weather/city/'.$forecast_citycode.'/project/'.$project.'/cs/'.$forecast_checksum;

$forecast_data = new SimpleXMLElement(file_get_contents($forecast_url));

function weathercom_replace($the_field) {
	$weather_replace_from = array('999'); // keine Angabe
	$weather_replace_to = array('wi-na');
	$weather_replace_from[] = '96'; // starkes Gewitter
	$weather_replace_to[] = 'wi-thunderstorm';
	$weather_replace_from[] = '95'; // leichtes Gewitter
	$weather_replace_to[] = 'wi-storm-showers';
	$weather_replace_from[] = '90'; // Gewitter
	$weather_replace_to[] = 'wi-thunderstorm';
	$weather_replace_from[] = '86'; // mäßiger oder starker Schnee - Schauer
	$weather_replace_to[] = 'wi-snow';
	$weather_replace_from[] = '85'; // leichter Schnee - Schauer
	$weather_replace_to[] = 'wi-snow';
	$weather_replace_from[] = '84'; // starker Schnee / Regen - Schauer
	$weather_replace_to[] = 'wi-snow';
	$weather_replace_from[] = '83'; // leichter Schnee / Regen - Schauer
	$weather_replace_to[] = 'wi-snow';
	$weather_replace_from[] = '82'; // starker Regen - Schauer
	$weather_replace_to[] = 'wi-showers';
	$weather_replace_from[] = '81'; // Regen - Schauer
	$weather_replace_to[] = 'wi-showers';
	$weather_replace_from[] = '80'; // leichter Regen - Schauer
	$weather_replace_to[] = 'wi-showers';
	$weather_replace_from[] = '75'; // starker Schneefall
	$weather_replace_to[] = 'wi-snow';
	$weather_replace_from[] = '73'; // mäßiger Schneefall
	$weather_replace_to[] = 'wi-snow';
	$weather_replace_from[] = '71'; // leichter Schneefall
	$weather_replace_to[] = 'wi-snow';
	$weather_replace_from[] = '70'; // leichter Schneefall
	$weather_replace_to[] = 'wi-snow';
	$weather_replace_from[] = '69'; // starker Schnee-Regen
	$weather_replace_to[] = 'wi-sleet';
	$weather_replace_from[] = '68'; // leichter Schnee-Regen
	$weather_replace_to[] = 'wi-sleet';
	$weather_replace_from[] = '67'; // mäßiger oder starker Regen, gefrierend
	$weather_replace_to[] = 'wi-rain';
	$weather_replace_from[] = '66'; // leichter Regen, gefrierend
	$weather_replace_to[] = 'wi-rain';
	$weather_replace_from[] = '65'; // starker Regen
	$weather_replace_to[] = 'wi-rain';
	$weather_replace_from[] = '63'; // mäßiger Regen
	$weather_replace_to[] = 'wi-rain';
	$weather_replace_from[] = '61'; // leichter Regen
	$weather_replace_to[] = 'wi-rain';
	$weather_replace_from[] = '60'; // leichter Regen
	$weather_replace_to[] = 'wi-rain';
	$weather_replace_from[] = '57'; // starker Sprühregen, gefrierend
	$weather_replace_to[] = 'wi-sprinkle';
	$weather_replace_from[] = '56'; // leichter Sprühregen, gefrierend
	$weather_replace_to[] = 'wi-sprinkle';
	$weather_replace_from[] = '55'; // starker Sprühregen
	$weather_replace_to[] = 'wi-sprinkle';
	$weather_replace_from[] = '53'; // Sprühregen
	$weather_replace_to[] = 'wi-sprinkle';
	$weather_replace_from[] = '51'; // leichter Sprühregen
	$weather_replace_to[] = 'wi-sprinkle';
	$weather_replace_from[] = '50'; // Sprühregen
	$weather_replace_to[] = 'wi-sprinkle';
	$weather_replace_from[] = '49'; // Nebel mit Reifbildung
	$weather_replace_to[] = 'wi-fog';
	$weather_replace_from[] = '48'; // Nebel mit Reifbildung
	$weather_replace_to[] = 'wi-fog';
	$weather_replace_from[] = '45'; // Nebel
	$weather_replace_to[] = 'wi-fog';
	$weather_replace_from[] = '40'; // Nebel
	$weather_replace_to[] = 'wi-fog';
	$weather_replace_from[] = '30'; // bedeckt
	$weather_replace_to[] = 'wi-cloudy';
	$weather_replace_from[] = '20'; // wolkig
	$weather_replace_to[] = 'wi-cloudy';
	$weather_replace_from[] = '10'; // leicht bewölkt
	$weather_replace_to[] = 'wi-cloud';
	$weather_replace_from[] = '9'; // Gewitter
	$weather_replace_to[] = 'wi-thunderstorm';
	$weather_replace_from[] = '8'; // Schauer
	$weather_replace_to[] = 'wi-rain';
	$weather_replace_from[] = '7'; // Schnee
	$weather_replace_to[] = 'wi-snow';
	$weather_replace_from[] = '6'; // Regen
	$weather_replace_to[] = 'wi-rain';
	$weather_replace_from[] = '5'; // Sprühregen
	$weather_replace_to[] = 'wi-sprinkle';
	$weather_replace_from[] = '4'; // Nebel
	$weather_replace_to[] = 'wi-fog';
	$weather_replace_from[] = '3'; // bedeckt
	$weather_replace_to[] = 'wi-cloudy';
	$weather_replace_from[] = '2'; // wolkig
	$weather_replace_to[] = 'wi-cloudy';
	$weather_replace_from[] = '1'; // leicht bewölkt
	$weather_replace_to[] = 'wi-cloud';
	$weather_replace_from[] = '0'; // sonnig
	$weather_replace_to[] = 'wi-day-sunny';

  $total = count($weather_replace_from);
  for ($i=0; $i<$total; $i++) {
    $the_field = preg_replace('/'.$weather_replace_from[$i].'/',$weather_replace_to[$i],$the_field);
  }
  return $the_field;
}

?>