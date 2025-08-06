<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {
        // $projects = Project::withGlobalScope('minPrice')->open()->latest('id')->paginate(10);

       
        $projects = Project::latest('id')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        return view('projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $project = new Project();
        $request->validate([
            'image' => 'required|image|mimes:png,jpg',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',          
            'duration' => 'required',

        ]);

        // $data = $request->except('_token');

        // $data['user_id'] = Auth::guard('admin')->id();

        // //upload files
        // $img_name = time() . rand() . $request->file('image')->getClientOriginalName();
        // $request->file('image')->move(public_path('images'), $img_name);

        // $data = $request->except('_token');
        // $data['image'] = $img_name;

        // Project::create($data);

        // return redirect()->route('projects.index')
        //     ->with('msg', 'project added successfully')->with('type', 'success');

        $data = $request->except('_token');
        $adminId = Auth::guard('admin')->id();

        if (!$adminId) {
            return redirect()->back()->withErrors(['msg' => 'You must be logged in as admin.']);
        }
        $data['user_id'] = $adminId;

        // رفع الصورة
        $img_name = time() . rand() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $img_name);
        $data['image'] = $img_name;

        Project::create($data);
        return redirect()->route('admin.projects.index')
            ->with('msg', 'project added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
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


        $request->validate([
            'image' => 'nullable|image|mimes:png,jpg',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'duration' => 'required',
        ]);

        $project = Project::findOrFail($id);

        $data = $request->except('_token', '_method');

        $data['user_id'] = Auth::guard('admin')->id();

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            File::delete(public_path('images/' . $project->image));

            $img_name = time() . rand() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $img_name);

            $data['image'] = $img_name;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('msg', 'project updated successfully')->with('type', 'info');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Project::destroy($id);

        return redirect()->route('admin.projects.index')
            ->with('msg', 'project deleted successfully')->with('type', 'danger');
    }

    function trash()
    {
        $projects = Project::onlyTrashed()->latest('id')->paginate(10);

        return view('projects.trash', compact('projects'));
    }



    function restore($id)
    {
        Project::onlyTrashed()->find($id)->restore();
        // $project->update(['deleted_at' => null]);

        return redirect()->route('admin.projects.index')->with('msg', 'Project restored successfully')->with('type', 'info');
    }

    function forcedelete($id)
    {
        $project = Project::onlyTrashed()->find($id);
        File::delete(public_path($project->image));
        $project->forcedelete();
        // $project->update(['deleted_at' => null]);

        return redirect()->route('admin.projects.index')->with('msg', 'Project deleted permanently successfully')->with('type', 'info');
    }
}
