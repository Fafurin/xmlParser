<?php

namespace App\Services;

use App\Entity\News;
use App\Exceptions\NewsNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class NewsToDbService
{
    /**
     * @throws NewsNotFoundException
     */
    public function addNews(ManagerRegistry $doctrine, XmlParserService $xmlParser): void
    {
        $entityManager = $doctrine->getManager();

        $data = $xmlParser->getData('../public/rss.xml');

        foreach ($data as $item) {
            $news = new News();

            $news->setTitle($item['title']);
            $news->setDescription($item['description']);
            $news->setLink($item['link']);
            $news->setPubDate($item['pubDate']);

            $entityManager->persist($news);

            $entityManager->flush();
        }
    }
}