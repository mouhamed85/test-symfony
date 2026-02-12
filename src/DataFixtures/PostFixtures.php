<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private SluggerInterface $slugger
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $postsData = [
            [
                'title' => 'Getting Started with Symfony 7',
                'content' => 'Symfony 7 brings amazing new features and improvements. In this article, we\'ll explore the key changes and how to get started with your first Symfony 7 project. From improved performance to better developer experience, Symfony continues to be one of the best PHP frameworks available.',
                'category' => CategoryFixtures::CATEGORY_TECHNOLOGY,
            ],
            [
                'title' => 'The Future of Artificial Intelligence',
                'content' => 'Artificial Intelligence is transforming the way we live and work. This comprehensive guide explores the latest trends in AI, machine learning, and how these technologies are shaping our future. From natural language processing to computer vision, AI is everywhere.',
                'category' => CategoryFixtures::CATEGORY_TECHNOLOGY,
            ],
            [
                'title' => '10 Tips for a Healthy Lifestyle',
                'content' => 'Living a healthy lifestyle doesn\'t have to be complicated. Here are 10 simple tips that can make a big difference in your daily routine. From nutrition to exercise, we cover all the essentials for maintaining physical and mental wellness.',
                'category' => CategoryFixtures::CATEGORY_LIFESTYLE,
            ],
            [
                'title' => 'Mindfulness and Meditation for Beginners',
                'content' => 'Discover the power of mindfulness and meditation. This beginner\'s guide will help you understand the benefits and get started with simple techniques that you can practice anywhere. Learn how to reduce stress and improve focus through daily meditation.',
                'category' => CategoryFixtures::CATEGORY_LIFESTYLE,
            ],
            [
                'title' => 'Exploring the Beautiful Islands of Greece',
                'content' => 'Greece is home to some of the most stunning islands in the world. From the white-washed buildings of Santorini to the crystal-clear waters of Crete, this travel guide will help you plan your perfect Greek island adventure. Discover hidden gems and local secrets.',
                'category' => CategoryFixtures::CATEGORY_TRAVEL,
            ],
            [
                'title' => 'Backpacking Through Southeast Asia',
                'content' => 'Southeast Asia offers incredible experiences for budget travelers. This comprehensive guide covers everything you need to know about backpacking through Thailand, Vietnam, Cambodia, and beyond. Tips on accommodation, transportation, and must-see destinations included.',
                'category' => CategoryFixtures::CATEGORY_TRAVEL,
            ],
            [
                'title' => 'Mastering French Cuisine at Home',
                'content' => 'French cuisine is renowned worldwide for its elegance and flavor. Learn the secrets of French cooking with these classic recipes and techniques. From coq au vin to crème brûlée, you\'ll discover that French cooking can be accessible and fun.',
                'category' => CategoryFixtures::CATEGORY_FOOD,
            ],
            [
                'title' => 'Plant-Based Recipes for Every Day',
                'content' => 'Going plant-based has never been easier or more delicious. Explore these nutritious and flavorful recipes that will make you forget about meat. Perfect for beginners and experienced cooks alike, these dishes are packed with flavor and nutrients.',
                'category' => CategoryFixtures::CATEGORY_FOOD,
            ],
            [
                'title' => 'Complete Guide to Marathon Training',
                'content' => 'Running a marathon is an incredible achievement. This training guide will take you from beginner to marathon-ready with a comprehensive 16-week training plan. Learn about proper nutrition, injury prevention, and race day strategies.',
                'category' => CategoryFixtures::CATEGORY_SPORTS,
            ],
            [
                'title' => 'Home Workout Routines Without Equipment',
                'content' => 'You don\'t need a gym membership to stay fit. These effective home workout routines require no equipment and can be done anywhere. Build strength, improve flexibility, and boost your cardiovascular fitness from the comfort of your home.',
                'category' => CategoryFixtures::CATEGORY_SPORTS,
            ],
        ];

        foreach ($postsData as $index => $data) {
            $post = new Post();
            $post->setTitle($data['title']);
            $post->setContent($data['content']);
            $post->setSlug(strtolower($this->slugger->slug($data['title'])));
            $post->setCategory($this->getReference($data['category'], \App\Entity\Category::class));
            
            // Set created dates with some variation
            $daysAgo = rand(1, 30);
            $post->setCreatedAt(new \DateTimeImmutable("-{$daysAgo} days"));

            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
