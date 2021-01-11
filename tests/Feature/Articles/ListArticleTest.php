<?php

namespace Tests\Feature\Articles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Article;

class ListArticleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_fetch_single_article()
    {
        //$this->withoutExceptionHandling();
        $article = Article::factory()->create();

        //$response = $this->getJson('/api/v1/articles/'.$article->getRouteKey())->dump();
        $response = $this->getJson(route('api.v1.articles.show', $article));
        //$response->assertSee($article->title);
        $response->assertJson([
            'data' => [
                'type'          => 'articles',
                'id'            => (string) $article->getRouteKey(),
                'attributes'    => [
                    'title' => $article->title,
                    'slug'  => $article->slug,
                    'content' => $article->content,
                ],
                'links' =>[
                    'self' => route('api.v1.articles.show', $article)
                ]
            ]
        ]);
    }

    public function test_can_fetch_all_articles()
    {
        //$this->withoutExceptionHandling();
        $articles = Article::factory()->times(3)->create();

        //$response = $this->getJson('/api/v1/articles/'.$article->getRouteKey())->dump();
        $response = $this->getJson(route('api.v1.articles.index'));
        
        $response->assertExactJson([
            'data' => [
                [
                    'type'          => 'articles',
                    'id'            => (string) $articles[0]->getRouteKey(),
                    'attributes'    => [
                        'title' => $articles[0]->title,
                        'slug'  => $articles[0]->slug,
                        'content' => $articles[0]->content,
                    ],
                    'links' =>[
                        'self' => route('api.v1.articles.show',$articles[0])
                    ]
                ],
                [
                    'type'          => 'articles',
                    'id'            => (string) $articles[1]->getRouteKey(),
                    'attributes'    => [
                        'title' => $articles[1]->title,
                        'slug'  => $articles[1]->slug,
                        'content' => $articles[1]->content,
                    ],
                    'links' =>[
                        'self' => route('api.v1.articles.show',$articles[1])
                    ]
                ],
                [
                    'type'          => 'articles',
                    'id'            => (string) $articles[2]->getRouteKey(),
                    'attributes'    => [
                        'title' => $articles[2]->title,
                        'slug'  => $articles[2]->slug,
                        'content' => $articles[2]->content,
                    ],
                    'links' =>[
                        'self' => route('api.v1.articles.show',$articles[2])
                    ]
                ],
            ],
            'links' => [
                'self' => route('api.v1.articles.index')
            ],
            'meta' => [
                'articles_count' => 3
            ]
        ]);
    }

    
}
