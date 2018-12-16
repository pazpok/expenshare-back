<?php
namespace App\Controller;
use App\Entity\Debt;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Class DebtController
 * @package App\Controller
 * @Route("/debt")
 */
class DebtController extends BaseController
{
    /**
     * @Route("/", name="debt", methods="GET")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $debt = $this->getDoctrine()->getRepository(Debt::class)
            ->findAll();

        if ($request->isXmlHttpRequest()){
            return $this->json($debt);
        }
        return $this->render('base.html.twig');
    }
}