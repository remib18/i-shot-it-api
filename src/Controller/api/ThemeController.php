<?php

namespace App\Controller\api;

use App\Entity\Theme;
use App\Form\ThemeType;
use App\Repository\ThemeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/theme')]
class ThemeController extends AbstractController
{
    #[Route('/', name: 'app_api_theme_index', methods: ['GET'])]
    public function index(ThemeRepository $themeRepository): Response
    {
        $themes = $themeRepository->findAll();
        return $this->json($themes);
    }

    #[Route('/current', name: 'app_api_theme_current', methods: ['GET'])]
    public function current(ThemeRepository $themeRepository): Response
    {
        $theme = $themeRepository->findOneByCurrentDate();
        return $this->json($theme);
    }

    #[Route('/{id}', name: 'app_api_theme_show', methods: ['GET'])]
    public function show(Theme $theme): Response
    {
        return $this->json($theme);
    }
}
