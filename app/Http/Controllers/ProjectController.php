<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $backUrl = 'Project';

    public function index()
    {
        $project = Project::all();
        return view('admin.pages.' . $this->backUrl . '.index', [
            'project' => $project,
            'backUrl' => $this->backUrl
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.' . $this->backUrl . '.create', [
            'backUrl' => $this->backUrl,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // pindah file gambar
        $imageName = $this->backUrl . '-cover-' . time() . '.' . $request->cover->extension();
        $request->cover->move(public_path('images/' . $this->backUrl . '/cover'), $imageName);

        $project = new Project();
        $project->name = $request->name;
        $project->slug = SlugService::createSlug(Project::class, 'slug', $request->name);
        $project->description = $request->description;
        $project->cover = $imageName;
        $project->save();
        return redirect()->route($this->backUrl)->with('post_success', $this->backUrl . ' Has Been Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $project = Project::where('slug', '=', $slug)->firstOrFail();
        return view('admin.pages.' . $this->backUrl . '.edit', [
            'project' => $project,
            'backUrl' => $this->backUrl,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $project = Project::where('slug', '=', $slug)->firstOrFail();
        if ($request->cover) {

            if (File::exists(public_path('images/' . $this->backUrl . '/cover/' . $post->cover))) {
                File::delete(public_path('images/' . $this->backUrl . '/cover/' . $post->cover));
            }

            // pindah file gambar
            $imageName = $this->backUrl . '-cover-' . time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('images/' . $this->backUrl . '/cover'), $imageName);

            $project->name = $request->name;
            $project->slug = SlugService::createSlug(Project::class, 'slug', $request->name);
            $project->description = $request->description;
            $project->cover = $imageName;
            $project->update();
        } else {
            $project->name = $request->name;
            $project->slug = SlugService::createSlug(Project::class, 'slug', $request->name);
            $project->description = $request->description;
            $project->update();
        }

        return redirect()->route($this->backUrl)->with('post_success', $this->backUrl . ' Has Been Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->delete()) {
            if (File::exists(public_path('images/' . $this->backUrl . '/cover/' . $project->cover))) {
                File::delete(public_path('images/' . $this->backUrl . '/cover/' . $project->cover));
            } else {
            }
            return response()->json([
                'success' => $this->backUrl . ' Deleted',
            ]);
        }
        return response()->json([
            'error' => $this->backUrl . ' Not Found',
        ]);
    }
}