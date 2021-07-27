<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $a1 = new Aliment();
        $a1->setNom("Carotte")
            ->setCalorie(76)
            ->setPrix(80)
            ->setImage("aliments/corotte.png")
            ->setProteine(0.98)
            ->setGlucide(4.16)
            ->setLipide(0.63);
        $manager->persist($a1);
        $a2 = new Aliment();
        $a2->setNom("Patate")
            ->setCalorie(36)
            ->setPrix(50)
            ->setImage("aliments/patate.png")
            ->setProteine(0.68)
            ->setGlucide(5.86)
            ->setLipide(0.13);
        $manager->persist($a2);
        $a3 = new Aliment();
        $a3->setNom("Tomate")
            ->setCalorie(86)
            ->setPrix(40)
            ->setImage("aliments/tomate.png")
            ->setProteine(0.28)
            ->setGlucide(4.56)
            ->setLipide(0.43);
        $manager->persist($a3);
        $a4 = new Aliment();
        $a4->setNom("Pomme")
            ->setCalorie(26)
            ->setPrix(90)
            ->setImage("aliments/pomme.png")
            ->setProteine(0.78)
            ->setGlucide(4.26)
            ->setLipide(0.13);
        $manager->persist($a4);


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}