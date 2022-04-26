<?php

namespace App\Controller;


use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/books")
     */
    public function books(ManagerRegistry $doctrine): Response
    {
        $books = $doctrine->getRepository(Book::class)->findAll();
        dd($books);

        return $this->render('book/books.html.twig', [
            'books' => $books,
            'page_title' => 'Liste des Livres'
        ]);
    }

}
