<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new RedirectResponse($this->generateUrl('app_login'));
    }
}
