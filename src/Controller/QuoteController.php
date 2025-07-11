<?php

namespace App\Controller;

use App\Form\QuoteCreateForm;
use App\Repository\QuoteRepository;
use App\Service\Factory\QuoteFactory;
use App\Entity\AccountingDocument\Quote;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class QuoteController extends AbstractController
{
    #[Route('/dashboard/quotes', name: 'quote.index')]
    public function index(QuoteRepository $repository): Response
    {
        $quotes = $repository->findAll();
        return $this->render('quote/index.html.twig', [
            'quotes' => $quotes
        ]);
    }

    #[Route('/dashboard/quotes/create', name: 'quote.create')]
    public function create(Request $request, EntityManagerInterface $em, QuoteRepository $repository, QuoteFactory $quotefactory): Response
    {
        $quote = $quotefactory->createWithDefaultParams();
        $form = $this->createForm(QuoteCreateForm::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($quote);
            $em->flush();
            $this->addFlash("success", "Le devis a bien été créé !");
            return $this->redirectToRoute("quote.edit", ["id" => $quote->getId()]);
        }

        return $this->render('quote/create.html.twig', [
            'form' => $form
        ], new Response(
            status: $form->isSubmitted() ? Response::HTTP_UNPROCESSABLE_ENTITY : Response::HTTP_OK,
        ));
    }

    #[Route('/dashboard/quotes/{id}', name: 'quote.edit', methods: ["GET", "POST"])]
    public function edit(Quote $quote, Request $request, EntityManagerInterface $em): Response
    {
        return $this->render('quote/edit.html.twig', [
            'quote' => $quote
        ]);
    }

}
