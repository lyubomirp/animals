<?php


namespace App\Models;


class Bee extends Fliers
{
    public function __construct($name, $species, $sex, $dob, $image) {
        parent::__construct($name, $species, $sex, $dob, $image);
    }
}