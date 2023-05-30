<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
// use phpDocumentor\Reflection\DocBlock\Description;
// use phpDocumentor\Reflection\DocBlock\Description;

/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    public function save(Commande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Commande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // public function counTotal():  array
    // {
    //     return $this->createQueryBuilder('d')
    //         ->where('d.prix LIKE :prix')
    //         ->setParameter()
    //         ->orderBy('d.commande', 'ASC')
    //         ->getQuery()
    //         ->getResult()
    // }

    // public function countTotal() : array
    // {
    //     $cart = $this->getSession()->get('cart');
    //     $cartData = [];
    //     if($cart){
    //         foreach($cart as $id => $quantity){
    //             $plat = $this->em->getRepository(Plat::class)->findOneBy(['id' => $id]);
    //             if(!$plat){
    //                 $this->removeToCart($id);
    //                 continue;
    //             }
    //             $cartData[] = [
    //                 'plat' => $plat,
    //                 'quantity' => $quantity
    //             ];
    //         }
    //     }
    //     return $cartData;
    //     {% set total = null %}
    //                             {% for item in cart %}
    //                                 {% set total = total + (item.plat.prix * item.quantity) %}
    
    //                             {% endfor %}
    //                             <div> Total: <span >{{total}} €</span> </div>
    // }

    // public function countTotal(): array
    // {
        // SELECT SUM(prix) as total_prix FROM detail
        // JOIN commande ON commande.id = detail.commande_id
        // GROUP BY detail.commande_id
        // ORDER BY total_prix ASC
        // LIMIT 1;
    // }


    
//    /**
//     * @return Commande[] Returns an array of Commande objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Commande
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
