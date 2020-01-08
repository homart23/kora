<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
    $role = new Role();
    $role->setLibelle("supadmin");

    $manager->persist($role);


          $user = new User();
        $user->setPassword($this->encoder->encodePassword($user, "supadmin"));
        $user->setUsername("omarion");
        $user->setPrenom("omar");
        $user->setRole($role);
        $user->setRoles(json_encode(array("ROLE_SUPADMIN")));
        $user->setIsActive(true);

         $manager->persist($user);

        $manager->flush();
    }
}
