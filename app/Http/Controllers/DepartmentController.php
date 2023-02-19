<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
        $departments = $this->getAllDepartmentsWithManager();
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
        return view('preparation.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'department' => 'required|max:255',
        ]);

        $department = new Department();
        $department->department = (string) $request->input('department');
        $department->manager_user_fid = (int) $request->input('manager_user_fid');

        $department->save();

        return redirect()->back()->withSuccess('Department has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return void
     */
    public function show(Department $department): void
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
        $managerName = User::where('id', $department->manager_user_fid)->value('name');

        return view('preparation.departments.edit', compact('managerName', 'department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(Request $request, Department $department): RedirectResponse
    {
        //
        $request->validate([
            'department' => 'required|max:255',
        ]);

        $department->department = (string) $request->input('department');
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
    public function destroy(Request $request): void
    {
        //
        if($request->input('id'))
        {
            Department::destroy($request->input('id'));
        }
    }

    /**
     * Uploads an image to public/images
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function uploadImage(Request $request): RedirectResponse
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
     * Returns a collection with all departments and their respective manager
     *
     * @returns Collection
     */
    public function getAllDepartmentsWithManager(): \Illuminate\Support\Collection
    {
        $departmentsWithManager = DB::table('departments')
            ->leftJoin('users', 'departments.manager_user_fid', '=', 'users.id')
            ->select('departments.*', 'users.name as manager_name')
            ->get();

        return $departmentsWithManager;
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
