<?php

namespace App\Controller;

use App\Exceptions\NewsNotFoundException;
use App\Services\NewsToDbService;
use App\Services\XmlParserService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @throws NewsNotFoundException
     */
    #[Route('/news', name: 'create_news')]

    public function createNews(ManagerRegistry $doctrine, XmlParserService $xmlParser): Response
    {
        $newsService = new NewsToDbService();

        $newsService->addNews($doctrine, $xmlParser);

        $response = 'Новости добавлены в базу данных';

        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'response' => $response,
        ]);
    }


}
