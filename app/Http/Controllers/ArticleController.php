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
     * @OA\Get(
     *     path="/articles",
     *     @OA\Response(response="200", description="Display a listing of articles.")
     * )
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return $this->sendPaginator('Articles', $articles);
    }


     /**
     * @OA\Post(
     *     path="/articles",
     *     @OA\Response(response="200", description="Create new articles.")
     * )
     */
    public function store(CreateArticle $request)
    {
        $data = $request->validated();
        $article = Article::create($data);
        return $this->sendResponse('Article Created', $article);
    }

     /**
     * @OA\Get(
     *     path="/articles/{articleId}",
     *     @OA\Response(response="200", description="Display a particular Article.")
     * )
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
     * @OA\Delete(
     *     path="/articles",
     *     @OA\Response(response="200", description="Delete an article.")
     * )
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return $this->sendMessage('Article Deleted');
    }


     /**
     * @OA\Get(
     *     path="/articles/{id}",
     *     @OA\Response(response="200", description="Increate article likes")
     * )
     */
    public function likeArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->likes = $article->likes + 1;
        $article->save();

        return $this->sendMessage('Operation Succeeded');
    }

     /**
     * @OA\Get(
     *     path="/articles",
     *     @OA\Response(response="200", description="Increment article views")
     * )
     */
    public function viewArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->views = $article->views + 1;
        $article->save();

        return $this->sendMessage('Operation Succeeded');
    }


     /**
     * @OA\Get(
     *     path="/articles",
     *     @OA\Response(response="200", description="Display paginated comments of an article")
     * )
     */
    public function comments($id)
    {
        $article = Article::findOrFail($id);
        $comments = Comment::where('article_id', $article->id)->latest()->paginate(10);
        return $this->sendPaginator('Comments', $comments);
    }


     /**
     * @OA\Post(
     *     path="/articles",
     *     @OA\Response(response="200", description="Adds comment to an article")
     * )
     */
    public function addComment($id, CommentRequest $request)
    {
        $data = $request->validated();

        $article = Article::findOrFail($id);
        $data['article_id'] = $id;
        Comment::create($data);
        return $this->sendMessage('Your message has been successfully sent');
    }
}
