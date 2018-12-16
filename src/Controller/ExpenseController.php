<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Expense;
/**
 * Class ExpenseController
 * @package App\Controller
 * @Route("/expense")
 */
class ExpenseController extends BaseController
{
    /**
     * @Route("/", name="expense", methods="GET")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $expense = $this->getDoctrine()->getRepository(Expense::class)
            ->findAll();

        if ($request->isXmlHttpRequest()){
            return $this->json($expense);
        }
        return $this->render('base.html.twig');
    }
}