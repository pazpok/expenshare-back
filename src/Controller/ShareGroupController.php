<?php
namespace App\Controller;
use App\Entity\ShareGroup;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class ShareGroupController
 * @package App\Controller
 * @Route("/share_group")
 */
class ShareGroupController extends BaseController
{
    /**
     * @Route("/", name="share_group", methods="GET")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $sharegroup = $this->getDoctrine()->getRepository(ShareGroup::class)
            ->findAll();

        if ($request->isXmlHttpRequest()){
            return $this->json($sharegroup);
        }
        return $this->render('base.html.twig');
    }
}
