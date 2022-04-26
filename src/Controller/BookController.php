<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

     #[Route("/books")]

    public function books(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();

        return $this->render('book/books.html.twig', [
            'books' => $books,
            'page_title' => 'Liste des Livres'
        ]);
    }

}
