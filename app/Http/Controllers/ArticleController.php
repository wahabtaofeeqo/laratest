<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Comment;

use App\Http\Requests\CreateArticle;
use App\Http\Requests\CommentRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return $this->sendPaginator('Articles', $articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticle $request)
    {
        $data = $request->validated();
        $article = Article::create($data);
        return $this->sendResponse('Article Created', $article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with('tags')->findOrFail($id);
        return $this->sendResponse('Article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return $this->sendMessage('Article Deleted');
    }

    public function likeArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->likes = $article->likes + 1;
        $article->save();

        return $this->sendMessage('Operation Succeeded');
    }

    public function viewArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->views = $article->views + 1;
        $article->save();

        return $this->sendMessage('Operation Succeeded');
    }

    public function comments($id)
    {
        $article = Article::findOrFail($id);
        $comments = Comment::where('article_id', $article->id)->latest()->paginate(10);
        return $this->sendPaginator('Comments', $comments);
    }

    public function addComment($id, CommentRequest $request)
    {
        $data = $request->validated();

        $article = Article::findOrFail($id);
        $data['article_id'] = $id;
        Comment::create($data);
        return $this->sendMessage('Your message has been successfully sent');
    }
}
