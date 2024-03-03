<?php

namespace App\Http\Controllers\Backend;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skills = Skill::all();
        return view('projects.create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        if($request->hasFile('image')){
            $image = $request->file('image')->store('projects');

            Project::create([
                'skill_id' => $request->skill_id,
                'name' => $request->name,
                'project_url' => $request->project_url,
                'image' => $image
            ]);

            return to_route('projects.index');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $skills = Skill::all();
        return view('projects.edit', compact('project', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $image = $project->image;
        if($request->hasFile('image')){
            Storage::delete($project->image);
            $image = $request->file('image')->store('projects');
        }

        $project->update([
            'skill_id' => $request->skill_id,
            'name' => $request->name,
            'project_url' => $request->project_url,
            'image' => $image
        ]);

        return to_route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();

        return back();
    }
}
