<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookSearchFormType;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BookController extends AbstractController
{

     #[Route("/", name: 'book_listing', methods:['GET','POST'])]

    public function books(BookRepository $bookRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $form = $this->createForm(BookSearchFormType::class);
        $form->handleRequest($request);
        $searchFormValues = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $searchFormValues = $form->getData();
        }
        $query = $bookRepository->findBooksWithAuthor($searchFormValues);
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );
        return $this->render('book/books.html.twig', [
            'books' => $pagination,
            'page_title' => 'Liste des Livres',
            'form' => $form->createView(),
        ]);
    }
    #[Route('/book/create', name: 'book_create', methods:['GET', 'POST'])]
    public function bookNew(Request $request, EntityManagerInterface $entityManager):Response
    {
        $newBook = new Book();
        $form = $this->createForm(BookType::class, $newBook);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $bookToSave = $form->getData();
            $entityManager->persist($bookToSave);
            $entityManager->flush();

            $this->addFlash('success', 'Votre livre à été créé avec succès.');

            return $this->redirectToRoute('book_listing');
        }

        return $this->render('book/bookNew.html.twig', [
            'bookForm'=> $form->createView()
        ]);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    #[Route('/book/{id}', name: 'book_detail', methods:['GET'])]
    public function bookDetail($id, BookRepository $bookRepository): Response
    {
        $book = $bookRepository->findOneBookByIdWithAuthorAndBookKind($id);

        return $this->render('/book/detail.html.twig',
        [
            'book' => $book,
        ]);
    }

    #[Route('/book/{id}/edit', name: 'app_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book, BookRepository $bookRepository): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookRepository->add($book);
            $this->addFlash('success', 'Votre livre à été modifié avec succès.');
            return $this->redirectToRoute('book_listing', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('book/bookEdit.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/book/{id}', name: 'book_delete', methods: ['POST'])]
    public function bookDelete(Request $request, Book $book, BookRepository $bookRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $bookRepository->remove($book);
        }

        return $this->redirectToRoute('book_listing', [], Response::HTTP_SEE_OTHER);
    }
}
