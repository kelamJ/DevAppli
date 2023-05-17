<?php

namespace App\DataFixtures;

use App\Entity\Adress;
use App\Entity\Plat;
use App\Entity\Commande;
use App\Entity\Categorie;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Jeu1 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
                
        $categorie1 = new Categorie();

        $categorie1->setLibelle("Pizza")
                ->setImage("pizza_cat.jpg")
                ->setActive("1");


        $categorie2 = new Categorie();

        $categorie2->setLibelle("Burger")
                ->setImage("burger_cat.jpg")
                ->setActive("1");


        $categorie3 = new Categorie();

        $categorie3->setLibelle("Wraps")
                ->setImage("wrap_cat.jpg")
                ->setActive("1");



            $manager->persist($categorie1);
            $manager->persist($categorie2);
            $manager->persist($categorie3);

        $plat1 = new Plat();

        $plat1->setLibelle("Pizza Bianca")
            ->setDescription("Une pizza fine et croustillante garnie de crème mascarpone légèrement citronnée et de tranches de saumon fumé, le tout relevé de baies roses et de basilic frais.")
            ->setPrix("14.00")
            ->setImage("pizza-salmon.png")
            ->setActive("1");

        $plat2 = new Plat();

        $plat2->setLibelle("District Burger")
            ->setDescription("Burger composé d’un bun’s du boulanger, deux steaks de 80g (origine française), de deux tranches poitrine de porc fumée, de deux tranches cheddar affiné, salade et oignons confits.")
            ->setPrix("8.00")
            ->setImage("hamburger.jpg")
            ->setActive("1");

        $plat3 = new Plat();

        $plat3->setLibelle("Buffalo Chicken Wrap")
            ->setDescription("Du bon filet de poulet mariné dans notre spécialité sucrée & épicée, enveloppé dans une tortilla blanche douce faite maison.")
            ->setPrix("5.00")
            ->setImage("buffalo-chicken.webp")
            ->setActive("1");

        $plat4 = new Plat();

        $plat4->setLibelle("Pizza Margherita")
            ->setDescription("Une authentique pizza margarita, un classique de la cuisine italienne! Une pâte faite maison, une sauce tomate fraîche, de la mozzarella Fior di latte, du basilic, origan, ail, sucre, sel & poivre...")
            ->setPrix("14.00")
            ->setImage("pizza-margherita.jpg")
            ->setActive("1");

        $plat5 = new Plat();

        $plat5->setLibelle("Cheeseburger")
            ->setDescription("Burger composé d’un bun’s du boulanger, de salade, oignons rouges, pickles, oignon confit, tomate, d’un steak d’origine Française, d’une tranche de cheddar affiné, et de notre sauce maison.")
            ->setPrix("8.00")
            ->setImage("cheesburger.jpg")
            ->setActive("1");


            $manager->persist($plat1);
            $manager->persist($plat2);
            $manager->persist($plat3);
            $manager->persist($plat4);
            $manager->persist($plat5);

        $user1 = new User();

        $user1->setEmail("admin@test.fr")
            ->setPassword(password_hash("password",PASSWORD_DEFAULT))
            ->setNom("Malek")
            ->setPrenom("Julien")
            ->setTelephone("0762198800")
            ->setIsVerified('0')
            ->setRoles(['ROLE_ADMIN']);

        $user2 = new User();

        $user2->setEmail("testeur@test.fr")
            ->setPassword(password_hash("password",PASSWORD_DEFAULT))
            ->setNom("Diouf")
            ->setPrenom("Geoffrey")
            ->setTelephone("0765987125")
            ->setIsVerified('0')
            ->setRoles(['ROLE_PRODUCT_ADMIN']);
            

            $manager->persist($user1);
            $manager->persist($user2);

        $commande1 = new Commande();

        $commande1->setDateCommande(new \DateTime())
                ->setTotal("16.00")
                ->setEtat("3");

        $commande2 = new Commande();

        $commande2->setDateCommande(new \DateTime())
                ->setTotal("8.00")
                ->setEtat("3");

        $commande3 = new Commande();

        $commande3->setDateCommande(new \DateTime())
                ->setTotal("20.00")
                ->setEtat("3");

            $manager->persist($commande1);
            $manager->persist($commande2);
            $manager->persist($commande3);

        $plat1->setCategorie($categorie1);
        $plat2->setCategorie($categorie2);
        $plat3->setCategorie($categorie3);
        $plat4->setCategorie($categorie1);
        $plat5->setCategorie($categorie2);

        $commande1->setUtilisateur($user1);
        $commande2->setUtilisateur($user2);
        $commande3->setUtilisateur($user1);

        $adress1 = new Adress();

        $adress1->setTitle("Ma maison")
                ->setPrenom("Julien")
                ->setNom("Malek")
                ->setAdress("73 Avenue de la joie")
                ->setPostalcode("80000")
                ->setCountry("France")
                ->setPhone("0762198700")
                ->setCity("Amiens");

        $adress2 = new Adress();

                $adress2->setTitle("Le voisin")
                ->setPrenom("Geoffrey")
                ->setNom("Fleur")
                ->setAdress("15 rue de la chatte")
                ->setPostalcode("60000")
                ->setCountry("France")
                ->setPhone("0324329588")
                ->setCity("Beauvais");
        
        $manager->persist($adress1);
        $manager->persist($adress2);
        $manager->flush();
    }
}
