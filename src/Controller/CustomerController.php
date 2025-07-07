<?php

namespace App\Controller;

use App\Entity\Customer\Company;
use App\Entity\Customer;
use App\Entity\Customer\Individual;
use App\Form\CustomerCompanyForm;
use App\Form\CustomerIndividualForm;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CustomerController extends AbstractController
{
    #[Route('/dashboard/customers', name: 'customer.index')]
    public function index(CustomerRepository $repository): Response
    {
        $customers = $repository->findAll();
        return $this->render('customer/index.html.twig', [
            'customers' => $customers
        ]);
    }

    #[Route('/dashboard/customers/{id}', name: 'customer.show', requirements: ['id' => '\d+'])]
    public function show(Customer $customer): Response
    {
        return $this->render('customer/show.html.twig', [
            'customer' => $customer
        ]);
    }

    #[Route('/dashboard/customers/{id}/edit', name: 'customer.edit', methods: ["GET", "POST"])]
    public function edit(Customer $customer, Request $request, EntityManagerInterface $em): Response
    {
        $formClass = $customer instanceof Company ? CustomerCompanyForm::class : CustomerIndividualForm::class;
        $form = $this->createForm($formClass, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash("success", "Le client a bien été modifié !");
            return $this->redirectToRoute("customer.index");
        }

        return $this->render('customer/edit.html.twig', [
            'customer' => $customer,
            'form' => $form
        ]);
    }

    #[Route('/dashboard/customers/create/company', name: 'customer.create.company')]
    public function createCompany(Request $request, EntityManagerInterface $em): Response {
        $customer = new Company();
        return $this->processCustomerFormCreate($request, $em, $customer, "company", CustomerCompanyForm::class);
    }

    #[Route('/dashboard/customers/create/individual', name: 'customer.create.individual')]
    public function createIndividual(Request $request, EntityManagerInterface $em): response {
        $customer = new Individual();
        return $this->processCustomerFormCreate($request, $em, $customer, "individual", CustomerIndividualForm::class);
    }

    private function processCustomerFormCreate(Request $request, EntityManagerInterface $em, Customer $customer, string $type, string $formClass): Response
    {
        $form = $this->createForm($formClass, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($customer);
            $em->flush();
            $this->addFlash("success", "Le client a bien été créé !");
            return $this->redirectToRoute("customer.index");
        }

        return $this->render('customer/create.html.twig', [
            'form' => $form,
            'type' => $type
        ], new Response(
            status: $form->isSubmitted() ? Response::HTTP_UNPROCESSABLE_ENTITY : Response::HTTP_OK,
        ));
    }

    #[Route('/dashboard/customers/{id}/delete', name: 'customer.delete', methods: ["DELETE"])]
    public function remove(Customer $customer, EntityManagerInterface $em)
    {
        $em->remove($customer);
        $em->flush();
        $this->addFlash("success", "Le client a bien été supprimé !");
        return $this->redirectToRoute("customer.index");
    }
}
