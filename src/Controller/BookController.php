<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractController
{

     #[Route("/", name: 'book_listing', methods:['GET','POST'])]

    public function books(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();

        return $this->render('book/books.html.twig', [
            'books' => $books,
            'page_title' => 'Liste des Livres'
        ]);
    }
    #[Route('/create', name: 'book_create', methods:['GET', 'POST'])]
    public function bookNew(Request $request, EntityManagerInterface $entityManager):Response
    {
        $newBook = new Book();
        $form = $this->createForm(BookType::class, $newBook);
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
    #[Route('/{id}', name: 'book_detail', methods:['GET'])]
    public function bookDetail($id, BookRepository $bookRepository): Response
    {
        $book = $bookRepository->find($id);

        return $this->render('/book/detail.html.twig',
        [
            'book' => $book,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book, BookRepository $bookRepository): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookRepository->add($book);
            return $this->redirectToRoute('book_listing', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('book/bookEdit.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'book_delete', methods: ['POST'])]
    public function bookDelete(Request $request, Book $book, BookRepository $bookRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $bookRepository->remove($book);
        }

        return $this->redirectToRoute('book_listing', [], Response::HTTP_SEE_OTHER);
    }
}
