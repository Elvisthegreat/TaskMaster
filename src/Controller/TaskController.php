<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TaskmasterRepository;
use App\Entity\Taskmaster;
use App\Form\TaskmasterForm;

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

    #[Route('/task/{id}', name: 'task_show')]
    public function show(Taskmaster $task): Response
    {
        return $this->render('/task/show.html.twig', [
            'task' => $task
        ]);
    }

    // This route is for creating a new task
    #[Route('/task/newForm', name: 'task_new_form')]
    public function newForm(): Response
    {
        return $this->render('/task/newForm.html.twig', [
            
        ]);
    }
}