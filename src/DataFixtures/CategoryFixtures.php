<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_TECHNOLOGY = 'category-technology';
    public const CATEGORY_LIFESTYLE = 'category-lifestyle';
    public const CATEGORY_TRAVEL = 'category-travel';
    public const CATEGORY_FOOD = 'category-food';
    public const CATEGORY_SPORTS = 'category-sports';

    public function load(ObjectManager $manager): void
    {
        $categoriesData = [
            [
                'name' => 'Technology and Innovation',
                'content' => 'Explore the latest in technology, programming, AI, and digital innovation.',
                'reference' => self::CATEGORY_TECHNOLOGY,
            ],
            [
                'name' => 'Lifestyle and Wellness',
                'content' => 'Tips and insights on living a balanced, healthy, and fulfilling lifestyle.',
                'reference' => self::CATEGORY_LIFESTYLE,
            ],
            [
                'name' => 'Travel and Adventure',
                'content' => 'Discover amazing destinations, travel tips, and adventure stories from around the world.',
                'reference' => self::CATEGORY_TRAVEL,
            ],
            [
                'name' => 'Food and Cooking',
                'content' => 'Delicious recipes, cooking techniques, and culinary experiences.',
                'reference' => self::CATEGORY_FOOD,
            ],
            [
                'name' => 'Sports and Fitness',
                'content' => 'Stay active with sports news, fitness tips, and workout routines.',
                'reference' => self::CATEGORY_SPORTS,
            ],
        ];

        foreach ($categoriesData as $data) {
            $category = new Category();
            $category->setName($data['name']);
            $category->setContent($data['content']);
            $category->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($category);
            
            // Add reference for use in PostFixtures
            $this->addReference($data['reference'], $category);
        }

        $manager->flush();
    }
}
