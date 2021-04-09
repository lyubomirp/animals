<?php


namespace App\Models;


use App\Interfaces\Activity;
use App\Traits\Eat;

class Lion extends Animal
    implements Activity
{
    use Eat;

    public function __construct($name, $species, $sex, $dob, $image) {
        parent::__construct($name, $species, $sex, $dob, $image);
    }

    public function do_activity() : string
    {
        return 'wrrrrr';
    }

}