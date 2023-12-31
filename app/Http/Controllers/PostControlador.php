<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Post;
use Illuminate\Http\Request;

class PostControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('index', compact(['posts']));
    }

    public function store(Request $request)
    {
        $path = $request->file('arquivo')->store('imagens','public');

        $post = new Post();
        $post->email = $request->input('email'); 
        $post->mensagem = $request->input('mensagem'); 
        $post->arquivo = $path; 
        $post->save();

        return redirect('/');
    }

    public function destroy($id) {
        $post = Post::find($id);
        if (isset($post)) {
            Storage::disk('public')->delete($post->arquivo); 
            $post->delete();
        }
        return redirect('/');
    }

    public function download($id) {
        $post = Post::find($id);
        if (isset($post)) {
            $path =  Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($post->arquivo);
            return response()->download($path);
        }
        return redirect('/');
    }
}
