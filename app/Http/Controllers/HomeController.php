<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $featuredProjects = Project::published()->featured()
            ->with('category')
            ->orderBy('order')
            ->take(6)
            ->get()
            ->map(fn($p) => [
                'id'             => $p->id,
                'title'          => $p->title,
                'slug'           => $p->slug,
                'excerpt'        => $p->excerpt,
                'featured_image' => $p->featured_image ? asset('storage/' . $p->featured_image) : null,
                'category'       => $p->category?->name,
                'category_slug'  => $p->category?->slug,
            ]);

        $latestPosts = Post::published()
            ->with('category')
            ->orderByDesc('published_at')
            ->take(3)
            ->get()
            ->map(fn($p) => [
                'id'             => $p->id,
                'title'          => $p->title,
                'slug'           => $p->slug,
                'excerpt'        => $p->excerpt,
                'featured_image' => $p->featured_image ? asset('storage/' . $p->featured_image) : null,
                'category'       => $p->category?->name,
                'published_at'   => $p->published_at?->format('d M Y'),
                'reading_time'   => $p->reading_time,
            ]);

        return Inertia::render('Home', [
            'featuredProjects' => $featuredProjects,
            'latestPosts'      => $latestPosts,
        ]);
    }
}
