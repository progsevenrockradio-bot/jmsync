<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(): Response
    {
        $categories = Category::portfolio()->get()->map(fn($c) => [
            'id'   => $c->id,
            'name' => $c->name,
            'slug' => $c->slug,
        ]);

        $projects = Project::published()
            ->with('category')
            ->orderBy('order')
            ->get()
            ->map(fn($p) => [
                'id'             => $p->id,
                'title'          => $p->title,
                'slug'           => $p->slug,
                'excerpt'        => $p->excerpt,
                'featured_image' => $p->featured_image ? asset('storage/' . $p->featured_image) : null,
                'category'       => $p->category?->name,
                'category_slug'  => $p->category?->slug,
                'featured'       => $p->featured,
            ]);

        return Inertia::render('Portfolio/Index', [
            'projects'   => $projects,
            'categories' => $categories,
        ]);
    }

    public function show(Project $project): Response
    {
        abort_unless($project->published, 404);

        $project->load('category');

        $relatedProjects = Project::published()
            ->where('id', '!=', $project->id)
            ->where('category_id', $project->category_id)
            ->take(3)
            ->get()
            ->map(fn($p) => [
                'id'             => $p->id,
                'title'          => $p->title,
                'slug'           => $p->slug,
                'featured_image' => $p->featured_image ? asset('storage/' . $p->featured_image) : null,
            ]);

        return Inertia::render('Portfolio/Show', [
            'project' => [
                'id'             => $project->id,
                'title'          => $project->title,
                'excerpt'        => $project->excerpt,
                'description'    => $project->description,
                'featured_image' => $project->featured_image ? asset('storage/' . $project->featured_image) : null,
                'gallery'        => collect($project->gallery ?? [])->map(fn($img) => asset('storage/' . $img))->toArray(),
                'category'       => $project->category?->name,
                'client'         => $project->client,
                'project_url'    => $project->project_url,
                'completed_at'   => $project->completed_at ? $project->completed_at->format('Y') : null,
            ],
            'relatedProjects' => $relatedProjects,
        ]);
    }
}
