<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    public function create() {
        return view('articles.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|unique:articles|max:255',
            'content' => 'required',
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('articles.index');
    }

    public function show(Article $article) {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article) {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article) {
        $request->validate([
            'title' => 'required|max:255|unique:articles,title,' . $article->id,
            'content' => 'required',
        ]);

        $article->update($request->only('title', 'content'));
        return redirect()->route('articles.index');
    }

    public function destroy(Article $article) {
        $article->delete();
        return redirect()->route('articles.index');
    }
}
