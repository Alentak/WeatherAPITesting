<?php

class Weather{
    private $main;

    private $description;

    private $icon;

    public function __construct($main, $description, $icon)
    {
        $this->main = $main;
        $this->description = $description;
        $this->icon = $icon;
    }

    public function __get($value)
    {
        return $this->$value;
    }
}