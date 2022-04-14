<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProgrammerResource;
use App\Models\Programmer;
use App\Models\Project;

class ProgrammerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return a collection of programmers
        return ProgrammerResource::collection(Programmer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create the new resource
        $programmer = Programmer::create($request->all());

        // return the new resource
        return new ProgrammerResource($programmer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return the resource
        return new ProgrammerResource(Programmer::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // find the resource
        $programmer = Programmer::findOrFail($id);
        
        // update the resource
        $programmer->fill($request->all())->save();

        // return success response
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the resource
        $programmer = Programmer::findOrFail($id);
        
        // delete the resoucre
        $programmer->delete();
        
        // return success response
        return response()->json(['success' => true]);
    }

    /**
     * Assign a project to user by projectId
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignProject(Request $request, $id, $projectId)
    {
        // get the programmer
        $programmer = Programmer::findOrFail($id);
        
        // get the project (and check if does exist)
        $project = Project::findOrFail($projectId);

        // check if the project has been already assigned to this programmer
        if($programmer->hasProject($project)){
            // return response
            return response()->json(['success' => false, 'description' => 'Project has been already assigned to this programmer!']);
        }

        // assign the project to the user
        $programmer->projects()->attach($project->id);

        // return success response
        return response()->json(['success' => true, 'description' => 'Project assigned successfully!']);
    }

    /**
     * Remove a project from a user by projectId
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeProject(Request $request, $id, $projectId)
    {
        // get the programmer
        $programmer = Programmer::findOrFail($id);
        
        // get the project (and check if does exist)
        $project = Project::findOrFail($projectId);

        // check if the user has not been assigned this project
        if(!$programmer->hasProject($project)){
            // return response
            return response()->json(['success' => false, 'description' => 'Project has NOT been assigned to this programmer!']);
        }

        // remove the project from the user
        $programmer->projects()->detach($project->id);

        // return success response
        return response()->json(['success' => true, 'description' => 'Project removed successfully!']);
    }

}
