<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CustomerSearch extends AbstractController
{

    protected CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function __invoke(Request $request)
    {
        $q = $request->get('q');

        if (!$q) {
            throw new BadRequestHttpException("Vous devez fournir un paramètre 'q' pour votre recherche !");
        }

        $results = $this->customerRepository->searchWithQuery($q);

        return $results;
    }
}
