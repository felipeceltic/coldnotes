<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public $page = "blog";

    public $links = [
        'Início' => '/',
        'Blog' => '/blog',
    ];

    public function index()
    {
        $title = "Blog";

        $posts = Post::paginate(9);

        $links = $this->links;

        $tags = $this->popularTags();

        $categories = Post::getAllCategories();

        return view('blog/index', compact('posts', 'links', 'tags', 'categories', 'title'));
    }

    public function create()
    {
        $page = $this->page;
        return view('blog/create', compact('page'));
    }

    public function store(Request $request)
    {
        if($request->input('content') == null) {
            $request->session()->flash('message', 'Escreva o conteúdo da postagem!');
            return redirect()->back();
        }

        $post = new Post;

        $post->professional_id = Auth()->user()->id;
        $post->title = $request->input('title');
        $post->subtitle = $request->input('subtitle');
        $post->category_id = $request->input('category');
        $post->content = $request->input('content');
        $post->post_url = Post::generatePostUrl($post->title);

        if($request->input('tags') != null) {
            $post->tags = Post::convertTagsToStore($request->input('tags'));
        }

        $post->save();

        if($request->hasFile('imgs_url')) {

            $rand = rand(5, 7);
            $image = $request->file('imgs_url');
            $imageExtension = ".".$request->file('imgs_url')->extension();
            $imageName = "post-image-".$post->post_url.'-'.$rand.$imageExtension;
            $imageUpload = $request->file('imgs_url')->storeAs('blog', $imageName);
            $post->imgs_url = Storage::url($imageUpload);
            $post->save();

        }

        $request->session()->flash('message', 'Postagem criada!');
        return redirect()->route('dashboard.blog.myposts');
    }

    public function edit(Post $post)
    {
        $page = $this->page;

        if($post->tags != null) {
            $post->convertTagsToEdit();
        }

        return view('blog/edit', compact('post', 'page'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $oldData = $post->toArray();

        // Verifica se houveram alterações
        if($data["title"] == $oldData["title"] && $data["subtitle"] == $oldData["subtitle"] && $data["content"] == $oldData["content"]) {
            $request->session()->flash('message', 'Nenhuma alteração realizada!');
            return redirect()->back();
        }

        // Verifica e salva o que foi alterado no histórico
        $hData = [
            'changes' => [],
            'title' => '',
            'subtitle' => '',
            'content' => '',
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if($data["title"] != $oldData["title"]) {
            $hData["title"] = $oldData["title"];
            $post->title = $data["title"];
            array_push($hData["changes"], 'title');
        }

        if($data["subtitle"] != $oldData["subtitle"]) {
            $hData["subtitle"] = $oldData["subtitle"];
            $post->subtitle = $data["subtitle"];
            array_push($hData["changes"], 'subtitle');
        }

        if($data["content"] != $oldData["content"]) {
            $hData["content"] = $oldData["content"];
            $post->content = $data["content"];
            array_push($hData["changes"], 'content');
        }

        if($post->history == null) {
            $historyPost = [];
        } else {
            $historyPost = $post->history;
        }

        array_push($historyPost, $hData);
        $post->history = $historyPost;
        $post->save();

        $request->session()->flash('message', 'Alterações realizadas com sucesso!');
        return redirect()->back();
    }
}
