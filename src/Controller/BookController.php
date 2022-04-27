<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

     #[Route("/books", name: 'book_listing')]

    public function books(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();

        return $this->render('book/books.html.twig', [
            'books' => $books,
            'page_title' => 'Liste des Livres'
        ]);
    }
    #[Route('/book/create', name: 'book_create')]
    public function bookNew(Request $request, EntityManagerInterface $entityManager):Response
    {
        $newBook = new Book();
        $form = $this->createForm(\BookType::class, $newBook);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $bookToSave = $form->getData();
            $entityManager->persist($bookToSave);
            $entityManager->flush();

            return $this->redirectToRoute('book_listing');
        }
        return $this->render('book/bookNew.html.twig', [
            'bookForm'=> $form->createView()
        ]);
    }
    #[Route('/book/{id}', name: 'book_detail')]
    public function bookDetail($id, BookRepository $bookRepository): Response
    {
        $book = $bookRepository->find($id);
        return $this->render('book/detail.html.twig',
        [
            'book' => $book,
        ]);
    }

}
