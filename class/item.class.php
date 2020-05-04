<?php 

class WeatherItem{
    private $date;

    private $wind;

    private $weather;

    private $temp;

    public function __construct($date, $wind, $weather, $temp)
    {
        $this->date = $date;
        $this->wind = $wind;
        $this->weather = $weather;
        $this->temp = $temp;
    }

    public function __get($value)
    {
        return $this->$value;
    }
}