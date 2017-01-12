<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Author;
use AppBundle\Entity\News;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNewsData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime('2016-12-10');
        $author = $manager->getRepository('AppBundle:Author');
        $author = $author->findOneBy(array('name' => 'author'));

        $news = new News();
        $news->setTitle('SomeTitle');
        $content = file_get_contents('http://loripsum.net/api/1/plaintext');
        $news->setDescription($content);
        $content = file_get_contents('http://loripsum.net/api/3/plaintext');
        $news->setSubject($content);
        $news->setDate($date);
        $news->setAuthor($author);

        $manager->persist($news);



        $news1 = new News();
        $news1->setTitle('SomeTitle');
        $content = file_get_contents('http://loripsum.net/api/1/plaintext');
        $news1->setDescription($content);
        $content = file_get_contents('http://loripsum.net/api/3/plaintext');
        $news1->setSubject($content);
        $news1->setDate($date);
        $news1->setAuthor($author);

        $manager->persist($news1);


        $news2 = new News();
        $news2->setTitle('SomeTitle');
        $content = file_get_contents('http://loripsum.net/api/1/plaintext');
        $news2->setDescription($content);
        $content = file_get_contents('http://loripsum.net/api/3/plaintext');
        $news2->setSubject($content);
        $news2->setDate($date);
        $news2->setAuthor($author);

        $manager->persist($news2);



        $news3 = new News();
        $news3->setTitle('SomeTitle');
        $content = file_get_contents('http://loripsum.net/api/1/plaintext');
        $news3->setDescription($content);
        $content = file_get_contents('http://loripsum.net/api/3/plaintext');
        $news3->setSubject($content);
        $news3->setDate($date);
        $news3->setAuthor($author);

        $manager->persist($news3);


        $news4 = new News();
        $news4->setTitle('SomeTitle');
        $content = file_get_contents('http://loripsum.net/api/1/plaintext');
        $news4->setDescription($content);
        $content = file_get_contents('http://loripsum.net/api/3/plaintext');
        $news4->setSubject($content);
        $news4->setDate($date);
        $news4->setAuthor($author);

        $manager->persist($news4);



        $news5 = new News();
        $news5->setTitle('SomeTitle');
        $content = file_get_contents('http://loripsum.net/api/1/plaintext');
        $news5->setDescription($content);
        $content = file_get_contents('http://loripsum.net/api/3/plaintext');
        $news5->setSubject($content);
        $news5->setDate($date);
        $news5->setAuthor($author);

        $manager->persist($news5);


        $news6 = new News();
        $news6->setTitle('SomeTitle');
        $content = file_get_contents('http://loripsum.net/api/1/plaintext');
        $news6->setDescription($content);
        $content = file_get_contents('http://loripsum.net/api/3/plaintext');
        $news6->setSubject($content);
        $news6->setDate($date);
        $news6->setAuthor($author);

        $manager->persist($news6);

        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}