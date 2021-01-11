<?php

namespace Tests\Feature\Articles;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SortArticlesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function it_can_sort_articles_by_title_asc()
    {
        $article1 = Article::factory()->create(['title' => 'C Title']);
        $article2 = Article::factory()->create(['title' => 'A Title']);
        $article3 = Article::factory()->create(['title' => 'B Title']);

        $url = route('api.v1.articles.index', ['sort' => 'title']);
        
        $this->getJson($url)->assertSeeInOrder([
            'A Title',
            'B Title',
            'C Title',
        ]);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function it_can_sort_articles_by_title_desc()
    {
        Article::factory()->create(['title' => 'C Title']);
        Article::factory()->create(['title' => 'A Title']);
        Article::factory()->create(['title' => 'B Title']);

        $url = route('api.v1.articles.index', ['sort' => '-title']);
        
        $this->getJson($url)->assertSeeInOrder([
            'C Title',
            'B Title',
            'A Title',
        ]);
    }
}
