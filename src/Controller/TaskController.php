<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TaskmasterRepository;

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
}