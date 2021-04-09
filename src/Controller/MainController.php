<?php

namespace App\Controller;

use App\Models\CustomFile;
use Symfony\Component\HttpKernel\Exception\HttpException;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render("base.html.twig");
    }

    /**
     * @Route("/upload", name="upload")
     */
    public function upload(Request $request, ValidatorInterface $validator): Response
    {
        $animals = [];
        $file = new CustomFile($request->files->get("file"));
        $errors = $validator->validate($file);

        if (count($errors) > 0 || $file->file->getClientOriginalExtension() != "json") {
            $errorsString = (string)$errors;

            $response = new Response();

            $response->setStatusCode(403);
            $response->setContent($errorsString ? : "Please upload a json file");

            return $response;
        }

        $filename = $file->file->getClientOriginalName();
        $file->file->move("../public/tmp", $filename);

        $content = json_decode(file_get_contents("../public/tmp/$filename"));

        if (!$content) {
            unlink("../public/tmp/$filename");

            $response = new Response();

            $response->setStatusCode(403);
            $response->setContent("Couldn't parse JSON (possibly malformed)");

            return $response;
        }

        foreach ($content as $animal) {
            if (!isset($animal->species)) {
                continue;
            }

            $class = '\\App\\Models\\' . $animal->species;

            $curr_anim = new $class(
                $animal->name,
                $animal->species,
                $animal->sex,
                $animal->DOB,
                $animal->image
            );

            array_push($animals, $curr_anim);
        }

        unlink("../public/tmp/$filename");

        return $this->render("partial/slider.html.twig", ["animals" => $animals]);
    }
}
