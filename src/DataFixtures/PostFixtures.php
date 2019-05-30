<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Post;
use App\Entity\Comment;
use Faker;


class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // initialisation de l'objet Faker
        $faker = Faker\Factory::create('fr_FR');

        for($i = 1; $i < 30; $i++)
        {
            $post = new Post();
            
            $post->setContent($faker->paragraph);
            $post->setImage($faker->imageUrl($width = 240, $height = 180));
            $post->setCreatedAt(new \DateTime());
            
            $manager->persist($post);
     

        for ($k = 1; $k <= mt_rand(4, 10); $k++) {
            $comment = new Comment();


            $content = '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>';

            $now = new \DateTime();
            $intervalDate = $now->diff($post->getCreatedAt());
            $days = $intervalDate->days;
            $minimum = '-' . $days . ' days';


            $comment->setAuthor($faker->name);


            $comment->setContent($content);
            $comment->setCreatedAt($faker->dateTimeBetween($minimum));
            $comment->setArticle($post);


            $manager->persist($comment);



        }
        $manager->flush();

}
}

}

