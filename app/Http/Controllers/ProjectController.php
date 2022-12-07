<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
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
            'id' => 'nullable'
        ]);

        Project::create([
            'title' => $attributes['title'],
            'summary' => $attributes['summary'],
            'total_cost' => $attributes['cost'],
            'description' => $attributes['description']
        ]);

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
        ]);
    }

    public function index()
    {
        return Inertia::render('ProjectsIndex', [
            'projects' => Project::paginate(8)
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
            'id' => $project->id
        ]);
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'cost' => 'numeric|required',
            'description' => 'required',
            'id' => 'required'
        ]);

        Project::firstWhere('id', $attributes['id'])->update([
            'title' => $attributes['title'],
            'summary' => $attributes['summary'],
            'total_cost' => $attributes['cost'],
            'description' => $attributes['description']
        ]);

        return redirect('/admin/projects')->with(['message' => 'The project was updated']);
    }

    public function delete($id)
    {
        Project::firstWhere('id', $id)->delete();
    }
}
