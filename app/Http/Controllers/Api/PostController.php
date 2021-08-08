<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return response()->json([
            "posts"=>$posts
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'string|max:300|nullable',
            //$img_path = Storage::put('uploads', $data['image']);
        ]);

        $data = $request->all();
        $post = new Post();

        $post->fill($data);
        $post->slug = $this->generateSlug($post->title);

        //IMMAGINE DA IMPLEMENTARE
        //$image = NULL;
        //if (array_key_exists('image', $data)) {
            //$image = Storage::put('uploads', $data['image']);
            //$post->image = 'storage/'.$image;
        //}

        $post->save();

        //MAIL DA IMPLEMENTARE
        //$messageNewPost = 'Hai creato un nuovo Post!';
        //$subjectMail = 'Nuovo Post';
        //Mail::to(Auth::user()->email)->send(new SendNewMail(Auth::user()->name,$subjectMail,$messageNewPost));

        $post = Post::orderBy('id', 'desc')->first();

        // API
        return response()->json([
            'message' => 'saved',
            'post' => $post,
            'success' => true
        ]);
    }

    public static function generateSlug(string $title, bool $change = true, string $old_slug = ''){

        if (!$change) {
            $slug = $old_slug;
        }else {
            $slug = Str::slug($title, '-');
            $slug_base = $slug;

            $contatore = 1;
            $post_with_slug = Post::where('slug', '=', $slug)->first();

            while ($post_with_slug) {
                $slug = $slug_base . '-' . $contatore;
                $contatore++;
                $post_with_slug = Post::where('slug', '=', $slug)->first();
            }
        }
        return $slug;
    }
}
