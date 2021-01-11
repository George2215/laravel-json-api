<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    public function index()
    {
        return ArticleCollection::make(Article::all());

        //-title
        /*$direction = 'asc';
        $sortField = request('sort');

        if(Str::of($sortField)->startsWith('-')){
            $direction = 'desc';
            $sortField = Str::of($sortField)->substr(1);            
        }
        
        return ArticleCollection::make(
            Article::orderBy($sortField, $direction)->get()
            
        );*/
        
        /*return response()->json([
            'data' => Article::all()->map(function ($article){
                return [
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
                ];
            })
        ]);*/
    }

    public function show(Article $article)
    {        
        return ArticleResource::make($article);
        
        /*return response()->json([
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
        ]);*/
    }
}
