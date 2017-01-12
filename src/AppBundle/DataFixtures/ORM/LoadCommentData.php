<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime('2016-12-10');
        $news = $manager->getRepository('AppBundle:News')->findOneBy(array('id' => '4'));

        $comment = new Comment();
        $comment->setNews($news);
        $comment->setUsername('Jimme');
        $comment->setText('Blablablablablablablabla');
        $comment->setDate($date);
        $comment->setLikes(5);

        $manager->persist($comment);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}