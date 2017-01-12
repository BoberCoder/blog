<?php

namespace AppBundle\Services;

use AppBundle\Entity\Category;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EntityService
{

    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function createRecord($record)
    {
        $this->em->persist($record);
        $this->em->flush($record);
    }

    public function deleteRecord($record)
    {
        $this->em->remove($record);
        $this->em->flush();
    }

    public function showAllRecords()
    {
        $repository = $this->em->getRepository('AppBundle:News');
        $data = $repository->findAll();

        return $data;
    }

    public function editRecord($id)
    {

    }

}
