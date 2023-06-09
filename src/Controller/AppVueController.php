<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppVueController extends AbstractController
{
    /**
     * Show main page for exchange
     */
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('app_vue/index.html.twig');
    }
}
