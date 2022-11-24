<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $title = "ColdNotes";
        if (Auth::user() == null) {
            return view('posts.index');
        }

        $posts = Post::where('user_id', 'LIKE', Auth::user()->id)
        ->paginate(6);

        return view('posts.index', compact('posts', 'title'));
    }
    public function search(Request $request){

        $filter = $request->all();

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")
                        ->andWhere('user_id', 'LIKE', Auth::user()->id)
                        ->paginate(6);
        return view('posts.index', compact('posts', 'filter'));
    }

    public function create()
    {
        return view('posts.storepost');
    }

    public function store(Request $request)
    {
        if($request->input('content') == null) {
            $request->session()->flash('message', 'Escreva o conteúdo da postagem!');
            return redirect()->back();
        }

        $post = new Post;

        $post->user_id = Auth()->user()->id;
        $post->title = $request->input('title');
        $post->subtitle = $request->input('subtitle');
        $post->content = $request->input('content');
        $post->restored = 'criada';

        $post->save();

        $request->session()->flash('message', 'Postagem criada!');
        return redirect(route('post.index'));
    }

    public function edit($id)
    {
        return view('posts/updatepost', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $oldData = Post::find($id);
        $post = Post::find($id);

        // Verifica se houveram alterações
        if($data["title"] == $oldData["title"] && $data["subtitle"] == $oldData["subtitle"] && $data["content"] == $oldData["content"]) {
            // $request->session()->flash('message', 'Nenhuma alteração realizada!');
            return redirect()->back();
        }

        // Verifica e salva o que foi alterado no histórico
        $hData = [
            'changes' => [],
            'title' => '',
            'subtitle' => '',
            'content' => '',
            'restored' => 'editado',
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

        // $request->session()->flash('message', 'Alterações realizadas com sucesso!');
        return redirect(route('post.index'));
    }

    /**
     * soft delete post
     *
     * @return void
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->restored = null;
        $post->save();
        $post->delete();
        return redirect()->back();
    }

    /**
     * restore specific post
     *
     * @return void
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        $post->restored = "restaurado";
        $post->save();
        $post->restore();

        return redirect()->back();
    }

    public function deletedindex()
    {
        $title = "ColdNotes";

        $posts = Post::withTrashed()->where('restored', '=' ,null)->paginate(7);

        return view('posts.deletedindex', compact('posts', 'title'));
    }

    /**
     * restore all post
     *
     * @return response()
     */
    public function restoreAll()
    {
        Post::onlyTrashed()->restore();

        return redirect()->back();
    }
}
