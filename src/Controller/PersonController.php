<?php
namespace App\Controller;
use App\Entity\Expense;
use App\Entity\Person;
use App\Entity\ShareGroup;
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
     * @Route("/group/{slug}", name="person", methods="GET")
     */
    public function index(ShareGroup $shareGroup)
    {
        $person = $this->getDoctrine()->getRepository(Person::class)
            ->createQueryBuilder('p')
            ->select('p', 'e')
            ->leftJoin('p.expense', 'e')
            ->where('p.shareGroup = :group')
            ->setParameter(':group', $shareGroup)
            ->getQuery()
            ->getArrayResult()
        ;

        return $this->json($person);
    }

    /**
     * @Route("/", name="person_new", methods="POST")
     */
    public function new(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();

        $sharegroup = $em->getRepository(ShareGroup::class)->findOneBySlug($jsonData["slug"]);


        $person = new Person();
        $person->setFirstname($jsonData["firstname"]);
        $person->setLastname($jsonData["lastname"]);
        $person->setShareGroup($sharegroup);

        $em->persist($person);
        $em->flush();

        return $this->json($this->serialize($person));
    }
}