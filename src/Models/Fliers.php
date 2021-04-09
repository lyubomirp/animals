<?php


namespace App\Models;


use App\Interfaces\Activity;

class Fliers extends Animal
    implements Activity
{
    public function __construct($name, $species, $sex, $dob, $image) {
        parent::__construct($name, $species, $sex, $dob, $image);
    }

    public function do_activity() : string
    {
        return 'whoohooo';
    }
}