<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Taskmaster;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create a new Taskmaster entity
        $taskmaster = new Taskmaster();
        $taskmaster->setTitle('John Doe');
        $taskmaster->setDescription('Task description goes here.');
        $taskmaster->setStatus('In Progress');
        $taskmaster->setDueDate(\DateTime::createFromFormat('Y-m-d', '2023-12-31'));
        

        // Prepare the Taskmaster entity to be saved
        $manager->persist($taskmaster);

        $taskmaster = new Taskmaster();
        $taskmaster->setTitle('Jane Smith');
        $taskmaster->setDescription('Another task description.');
        $taskmaster->setStatus('Completed');
        $taskmaster->setDueDate(\DateTime::createFromFormat('Y-m-d', '2023-11-30'));

        // Prepare the Taskmaster entity to be saved
        $manager->persist($taskmaster);
        
        // Commit all pending changes, ensuring the entity is stored in the database
        $manager->flush();

    }
};
