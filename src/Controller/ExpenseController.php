<?php
namespace App\Controller;
use App\Entity\Category;
use App\Entity\Person;
use App\Entity\ShareGroup;
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
     * @Route("/group/{slug}", name="expense", methods="GET")
     */
    public function index(ShareGroup $shareGroup)
    {
        $expense = $this->getDoctrine()->getRepository(Expense::class)
        ->createQueryBuilder('e')
        ->select('e', 'p', 'c')
        ->leftJoin('e.person', 'p')
        ->leftJoin('e.category', 'c')
        ->where('p.shareGroup = :group')
        ->setParameter(':group', $shareGroup)
        ->getQuery()
        ->getArrayResult();

        return $this->json($expense);
    }

    /**
     * @Route("/", name="expense_new", methods="POST")
     */
    public function new(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository(Category::class)->find($jsonData["category"]);
        $person = $em->getRepository(Person::class)->find($jsonData["person"]);


        $expense = new Expense();
        $expense->setTitle($jsonData["title"]);
        $expense->setAmount($jsonData["amount"]);
        $expense->setCategory($category);
        $expense->setCreatedAt(new \DateTime());
        $expense->setPerson($person);

        $em->persist($expense);
        $em->flush();

        $exp = $this->getDoctrine()->getRepository(Expense::class)
            ->createQueryBuilder('e')
            ->where('e.id = :id')
            ->setParameter(':id', $expense->getId())
            ->getQuery()
            ->getArrayResult();

        return $this->json($exp[0]);
    }

    /**
     * @Route("/", name="expense_delete", methods="DELETE")
     */
    public function delete(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);


        $expense = $this->getDoctrine()->getRepository(Expense::class)->find($jsonData["expense"]);

        $em = $this->getDoctrine()->getManager();
        $em->remove($expense);
        $em->flush();

        return $this->json(["ok" => true]);
    }
}