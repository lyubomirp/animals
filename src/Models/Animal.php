<?php


namespace App\Models;


use Exception;

abstract class Animal
{
    public $age;
    public $name;
    public $species;
    public $sex;
    public $dob;
    public $image;

    /**
     * @throws Exception
     */
    function __construct($name, $species, $sex, $dob, $image) {
        $this->name     = $name;
        $this->species  = $species;
        $this->sex      = $sex;
        $this->dob      = $dob;
        $this->image    = $image;

        $this->calculateAge();
    }

    /**
     * @throws Exception
     */
    private function calculateAge() {
        $this->age = date_diff(new \DateTime($this->dob), new \DateTime())->y;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * @param mixed $species
     */
    public function setSpecies($species): void
    {
        $this->species = $species;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param mixed $dob
     */
    public function setDob($dob): void
    {
        $this->dob = $dob;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function sleep() {
        echo 'zzzzzz';
    }
}