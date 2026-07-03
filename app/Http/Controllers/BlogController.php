<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function index(): Response
    {
        $perPage    = config('jmsync.blog.items_per_page', 9);
        $categories = Category::blog()->get()->map(fn($c) => [
            'id'   => $c->id,
            'name' => $c->name,
            'slug' => $c->slug,
        ]);

        $posts = Post::published()
            ->with('category', 'author')
            ->orderByDesc('published_at')
            ->paginate($perPage)
            ->through(fn($p) => [
                'id'             => $p->id,
                'title'          => $p->title,
                'slug'           => $p->slug,
                'excerpt'        => $p->excerpt,
                'featured_image' => $p->featured_image ? asset('storage/' . $p->featured_image) : null,
                'category'       => $p->category?->name,
                'category_slug'  => $p->category?->slug,
                'author'         => $p->author?->name,
                'published_at'   => $p->published_at?->format('d M Y'),
                'reading_time'   => $p->reading_time,
            ]);

        return Inertia::render('Blog/Index', [
            'posts'      => $posts,
            'categories' => $categories,
        ]);
    }

    public function show(Post $post): Response
    {
        abort_unless($post->published, 404);

        $post->load('category', 'author');

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->orderByDesc('published_at')
            ->take(3)
            ->get()
            ->map(fn($p) => [
                'id'             => $p->id,
                'title'          => $p->title,
                'slug'           => $p->slug,
                'featured_image' => $p->featured_image ? asset('storage/' . $p->featured_image) : null,
                'published_at'   => $p->published_at?->format('d M Y'),
            ]);

        return Inertia::render('Blog/Show', [
            'post' => [
                'id'             => $post->id,
                'title'          => $post->title,
                'excerpt'        => $post->excerpt,
                'content'        => $post->content,
                'featured_image' => $post->featured_image ? asset('storage/' . $post->featured_image) : null,
                'category'       => $post->category?->name,
                'category_slug'  => $post->category?->slug,
                'author'         => $post->author?->name,
                'published_at'   => $post->published_at?->format('d \d\e F \d\e Y'),
                'reading_time'   => $post->reading_time,
                'tags'           => $post->tags ?? [],
            ],
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
