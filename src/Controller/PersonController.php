<?php
namespace App\Controller;
use App\Entity\Person;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Class PersonController
 * @package App\Controller
 * @Route("/person")
 */
class PersonController extends BaseController
{
    /**
     * @Route("/", name="person", methods="GET")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $person = $this->getDoctrine()->getRepository(Person::class)
            ->findAll();

        if ($request->isXmlHttpRequest()){
            return $this->json($person);
        }
        return $this->render('base.html.twig');
    }
}