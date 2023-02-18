<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        //
        $departments = $this->getAllDepartments();
        return view('preparation.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        //

        $users = User::all();

        return view('preparation.departments.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|max:255',
        ]);

        $department = new Department();
        $department->department = (string) $request->input('department');
        $department->manager_name = (string) $request->input('manager_name');
        $department->manager_user_fid = (int) $request->input('manager_user_fid');

        $department->save();

        return redirect()->back()->withSuccess('Department has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function edit(Department $department): View|Factory|Application
    {
        //
        $users = User::all();

        return view('preparation.departments.edit', compact('users', 'department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return Response
     */
    public function update(Request $request, Department $department)
    {
        //
        $request->validate([
            'department' => 'required|max:255',
        ]);

        $department->department = (string) $request->input('department');
        $department->manager_name = (string) $request->input('manager_name');
        $department->manager_user_fid = (int) $request->input('manager_user_fid');

        $department->save();

        return redirect()->back()->withSuccess('Department has been edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        //
        if($request->id)
        {
            Department::destroy($request->id);
        }
    }

    /**
     * Uploads an image to public/images
     *
     * @param Request $request
     * @return
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->save(public_path('images/' . $fileName));

            return back()->with('success', 'Image uploaded successfully!');
        }

        return back()->with('error', 'Please select an image to upload.');
    }

    /**
     * Returns a collection with all departments made
     *
     * @returns Collection
     */
    public function getAllDepartments(): \Illuminate\Support\Collection
    {
        return DB::table('departments')->get();
    }

    /**
     * Returns searched manager.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchManager(Request $request): JsonResponse
    {
        $managerName = $request->input('query');

        if($managerName) {
            $managers = DB::table('users')->select('name','email','id')
                ->where('name','like','%'.$managerName.'%')->get();
        } else {
            $managers = DB::table('users')->select('name','email','id')->get();
        }

        return response()->json([
            'managers' => $managers
        ]);
    }
}
