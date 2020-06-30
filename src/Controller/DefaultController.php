<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/test/index", name="test", methods={"GET"})
     */
    public function indexAction()
    {
        $apiResponse = ["asd" => true];

//        if($this->getUser()){
//           $apiResponse["meta"] = [
//               "roles" => $this->getUser()->getRoles(),
////               'token' => $this->getUser()->getToken()
//           ] ;
//
//        }


        return $this->json($apiResponse);

//        return new JsonResponse($apiResponse);
    }
}