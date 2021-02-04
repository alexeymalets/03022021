<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Mockery\Exception;
use Symfony\Component\DomCrawler\Crawler;

class ParserController extends Controller
{
    public function index()
    {
        $this->getContent('https://www.rbc.ru');
    }

    private function getContent($link)
    {
        $links = new Crawler($this->curl($link));

        $links->filter('.js-news-feed-list')->children()->each(function (Crawler $node, $i) use ($link) {
            if (strstr($node->filter('a')->attr('href'), $link)) {
                $news = new Crawler($this->curl($node->filter('a')->attr('href')));

                $title = $news->filter('.article__header__title-in')->text();

                $text = '';

                $textArray = $news->filter('.article__text_free p')->each(function (Crawler $node, $i) {
                    return $node->text();
                });

                foreach ($textArray as $str) {
                    $text = $text . $str;
                }

                if ($news->filter('.article__main-image__image')->count() > 0) {
                    $image = $news->filter('.article__main-image__image')->image()->getUri();
                } else {
                    $image = NULL;
                }

                Article::create(
                    array(
                        'title' => $title,
                        'text' => $text,
                        'img' => $image
                    )
                );
            }
        });
    }

    private function curl($link)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Chrome 11');

        $html = curl_exec($ch);

        curl_close($ch);

        return $html;
    }
}
