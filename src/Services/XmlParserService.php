<?php

namespace App\Services;

use App\Exceptions\NewsNotFoundException;

class XmlParserService implements ParserServiceInterface
{
    protected array $data = [];

    /**
     * @throws NewsNotFoundException
     * @throws \Exception
     */
    public function getData(string $xmlFile): array {

        $doc = new \DOMDocument();

        try {
            $loadFlag = $doc->load($xmlFile);
        } catch (NewsNotFoundException $e){
            throw new NewsNotFoundException("Ошибка загрузки xml-файла");
        }

        if ($loadFlag) {
            $items = $doc->getElementsByTagName('item');

            foreach ($items as $item){
                $titles = $item->getElementsByTagName('title');
                $title = htmlspecialchars($titles->item(0)->nodeValue);

                $descriptions = $item->getElementsByTagName('description');
                $description = htmlspecialchars($descriptions->item(0)->nodeValue);

                $links = $item->getElementsByTagName('link');
                $link = htmlspecialchars($links->item(0)->nodeValue);

                $pubDates = $item->getElementsByTagName('pubDate');
                $pubDate =  new \DateTime(trim($pubDates->item(0)->nodeValue));

                $this->data[] = [
                    'title' => $title,
                    'description' => $description,
                    'link' => $link,
                    'pubDate' => $pubDate
                ];
            }
            return ($this->data);
        } else {
            throw new NewsNotFoundException('Ошибка чтения xml-файла');
        }
    }

}