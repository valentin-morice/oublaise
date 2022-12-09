<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'cost' => 'numeric|required',
            'description' => 'required',
            'id' => 'nullable',
            'images_id' => 'required|array|distinct'
        ]);

        $project = Project::create([
            'title' => $attributes['title'],
            'summary' => $attributes['summary'],
            'total_cost' => $attributes['cost'],
            'description' => $attributes['description']
        ]);

        foreach ($attributes['images_id'] as $id) {
            Image::firstWhere('id', $id)->update([
                'project_id' => $project->id
            ]);
        }

        return redirect('/admin/projects')->with(['message' => 'The project was created']);
    }

    public function create()
    {
        return Inertia::render('ProjectsCreate', [
            'title' => '',
            'cost' => null,
            'summary' => '',
            'description' => '',
            'update' => false,
            'id' => null,
            'images' => null
        ]);
    }

    public function index()
    {
        $images = Image::where('project_id', 0)->get();

        foreach ($images as $image) {
            Storage::delete($image->path);
        }

        Image::where('project_id', 0)->delete();

        return Inertia::render('ProjectsIndex', [
            'projects' => Project::paginate(8)
        ]);
    }

    public function index_public()
    {
        return Inertia::render('ProjectsPublicIndex', [
            'projects' => Project::paginate(8)->load('images'),
        ]);
    }

    public function edit($id)
    {
        $project = Project::firstWhere('id', $id);

        return Inertia::render('ProjectsCreate', [
            'title' => $project->title,
            'cost' => $project->total_cost,
            'summary' => $project->summary,
            'description' => $project->description,
            'update' => true,
            'id' => $project->id,
            'images' => $project->images,
        ]);
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'cost' => 'numeric|required',
            'description' => 'required',
            'id' => 'required',
            'images_id' => 'nullable|array|distinct'
        ]);

        Project::firstWhere('id', $attributes['id'])->update([
            'title' => $attributes['title'],
            'summary' => $attributes['summary'],
            'total_cost' => $attributes['cost'],
            'description' => $attributes['description']
        ]);

        if (!empty($attributes['images_id'])) {
            foreach ($attributes['images_id'] as $id) {
                Image::firstWhere('id', $id)->update([
                    'project_id' => Project::firstWhere('id', $attributes['id'])->id
                ]);
            }
        }

        return redirect('/admin/projects')->with(['message' => 'The project was updated']);
    }

    public function delete($id)
    {
        Project::firstWhere('id', $id)->delete();
    }
}
