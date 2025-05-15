<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TaskmasterRepository;
use App\Entity\Taskmaster;
use App\Form\TaskmasterForm;
use Symfony\Component\HttpFoundation\Request;
// Handles entity operations such as persisting, updating, and deleting in the database
use Doctrine\ORM\EntityManagerInterface;


class TaskController extends AbstractController
{
    #[Route('/tasks', name: 'task_list')]
    public function list(TaskmasterRepository $repository): Response
    {
        // Fetch all tasks from the repository
        return $this->render('/task/list.html.twig', [
            'tasks' => $repository->findAll(),
        ]);
    }

        // Show a specific task and ensures only numeric IDs are passed <\d+>
    #[Route('/task/{id<\d+>}', name: 'task_show')]
    public function show(Taskmaster $task): Response
    {
        return $this->render('/task/show.html.twig', [
            'task' => $task
        ]);
    }

    // Create a new task
    #[Route('/task/new', name: 'task_new')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        // Create a new Taskmaster entity
        $task = new Taskmaster();

        // Create a form for the Taskmaster entity
        $form = $this->createForm(TaskmasterForm::class, $task);

        // Handle the request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($task);

            // Save the task to the database
            $manager->flush();
        }

        return $this->render('/task/new.html.twig', [
            'form' => $form,
        ]);
    }
}