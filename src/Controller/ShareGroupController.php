<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShareGroupController extends AbstractController
{
    /**
     * @Route("/sharegroup", name="sharegroup")
     */
    public function index()
    {
        return $this->render('sharegroup/index.html.twig', [
            'controller_name' => 'SharegroupController',
        ]);
    }
}
