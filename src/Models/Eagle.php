<?php


namespace App\Models;


use App\Traits\Eat;

class Eagle extends Fliers
{
    use Eat;

    public function __construct($name, $species, $sex, $dob, $image) {
        parent::__construct($name, $species, $sex, $dob, $image);
    }
}