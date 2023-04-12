<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    

    // #[Route('/', name: 'app_home')]
    // public function index(): Response
    // {
    //     $post = new Post;

    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //         'posts' => $post
            
    //     ]);
    // }

    #[Route('/', name: 'app_post_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }
}
