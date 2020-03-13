<?php

namespace App\DataFixtures;

use App\Entity\Cars;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $admin_user = new User();
        $admin_user->setEmail('admin@gmail.com');
        $admin_user->setPassword($this->passwordEncoder->encodePassword(
            $admin_user,
            'admin'
        ));
        $admin_user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($admin_user);

        $classic_user = new User();
        $classic_user->setEmail('user@gmail.com');
        $classic_user->setPassword($this->passwordEncoder->encodePassword(
            $classic_user,
            'user'
        ));
        $classic_user->setRoles(array('ROLE_USER'));
        $manager->persist($classic_user);

        $cars1 = new Cars();
        $cars1->setMarque("Citroen");
        $cars1->setModele("C2");
        $cars1->setAnnee(2005);
        $cars1->setPrix(2200);
        $cars1->setDateCirculation(\DateTime::createFromFormat('d-m-Y', "10-10-2005"));
        $cars1->setKilometrage(107000);
        $cars1->setCarburant("Essence");
        $cars1->setBoiteVitesse("Manuelle");
        $cars1->setCouleur("Bleu");
        $cars1->setNombrePortes(5);
        $cars1->setNombrePlaces(5);
        $cars1->setPuissanceFiscale(6);
        $cars1->setPuissanceDin(90);
        $cars1->setPermis(true);

        $manager->persist($cars1);

        $cars2 = new Cars();
        $cars2->setMarque("Mercedes");
        $cars2->setModele("Classe A");
        $cars2->setAnnee(2015);
        $cars2->setPrix(22600);
        $cars2->setDateCirculation(\DateTime::createFromFormat('d-m-Y', "11-01-2015"));
        $cars2->setKilometrage(17000);
        $cars2->setCarburant("Essence");
        $cars2->setBoiteVitesse("Automatique");
        $cars2->setCouleur("Noir");
        $cars2->setNombrePortes(5);
        $cars2->setNombrePlaces(5);
        $cars2->setPuissanceFiscale(7);
        $cars2->setPuissanceDin(110);
        $cars2->setPermis(true);
        
        $manager->persist($cars2);

        $cars3 = new Cars();
        $cars3->setMarque("Ford");
        $cars3->setModele("Focus");
        $cars3->setAnnee(2010);
        $cars3->setPrix(4100);
        $cars3->setDateCirculation(\DateTime::createFromFormat('d-m-Y', "20-08-2010"));
        $cars3->setKilometrage(92000);
        $cars3->setCarburant("Essence");
        $cars3->setBoiteVitesse("Manuelle");
        $cars3->setCouleur("Rouge");
        $cars3->setNombrePortes(5);
        $cars3->setNombrePlaces(5);
        $cars3->setPuissanceFiscale(6);
        $cars3->setPuissanceDin(95);
        $cars3->setPermis(true);
        
        $manager->persist($cars3);

        $manager->flush();
    }
}
