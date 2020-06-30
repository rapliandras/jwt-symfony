<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{

    /**
     * @Route("/test/index", name="test", methods={"GET"})
     */
    public function indexAction()
    {
        return new JsonResponse(["asd" => true]);
    }
}