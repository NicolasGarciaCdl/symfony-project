<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     */
    public function add(Book $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findBooksWithAuthor($searchFormValues)
    {

        dump($searchFormValues);
        $qb = $this->createQueryBuilder('book')
            ->select('book')
            ->leftJoin('book.author', 'author')
            ->addSelect('author')
        ;

        if (!empty($searchFormValues['title'])) {
            $qb->andWhere('book.title LIKE :title')
                ->setParameter('title', '%' . $searchFormValues['title'] .'%');
        }

        if (!empty($searchFormValues['author'])) {
            $qb->andWhere('book.author = :author')
                ->setParameter('author', $searchFormValues['author']);
        }

        if (!empty($searchFormValues['isbn'])) {
            $qb->andWhere('book.isbn = :isbn')
                ->setParameter('isbn', $searchFormValues['isbn']);
        }
        if (!empty($searchFormValues['kinds'])) {
            $qb->andWhere(':kinds MEMBER OF book.kinds')
                ->setParameter('kinds', $searchFormValues['kinds']);
        }

        $query = $qb->getQuery();
        return $query->execute();
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneBookByIdWithAuthorAndBookKind($id)
    {
        $qb = $this->createQueryBuilder('book')
            ->select('book')
            ->leftJoin('book.author', 'author')
            ->addSelect('author')
            ->leftJoin('book.kinds', 'kinds')
            ->addSelect('kinds')
            ->where('book.id = :id')
            ->setParameter('id', $id)
        ;

        $query = $qb->getQuery();
        return $query->getOneOrNullResult();
    }

    /**
     *
     */
    public function remove(Book $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
