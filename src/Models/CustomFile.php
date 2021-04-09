<?php

namespace App\Models;

use Symfony\Component\Validator\Constraints as Assert;

class CustomFile
{
    /**
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/json", "text/plain"},
     *     mimeTypesMessage = "Please upload a valid json"
     * )
     *
     * @Assert\NotBlank()
     */
    public $file;

    function __construct($file) {
        $this->file = $file;
    }
}