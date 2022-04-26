<?php
namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("lucky/number")
     * @return Response
     * @throws Exception
     */
    public function number(Request $request): Response
    {
        $number = random_int(0, 100);
        $books= [
            [
                'title' => 'titre 1'
            ],
            [
                'title' => 'Titre 2'
            ]
        ];

        return $this->render('lucky/number.html.twig', [
            'toto' => $number, 'books' => $books
        ]);

    }
}