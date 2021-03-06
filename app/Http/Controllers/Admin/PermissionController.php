<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        return view('admin.role.index')
        ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fetch(Request $request)
    {
        $roles = Role::select(['roles.id', 'roles.role_title', 'roles.role_group', 'roles.created_at', 'roles.updated_at'])->sorted();
        return Datatables::of($roles)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('role_title') && !empty($request->role_title)) {
                                $query->where('roles.role_title', 'like', "%{$request->get('role_title')}%");
                            }
                        })
                        ->addColumn('role_title', function ($genders) {
                            return Str::limit($roles->role_title, 100, '...');
                        })
                        ->addColumn('action', function ($genders) {
                            return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.role', ['id' => $roles->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>
						<li>
							<a href="javascript:void(0);" onclick="deleteRole(' . $roles->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
					</ul>
				</div>';
                        })
                        ->rawColumns(['role_title', 'action'])
                        ->setRowId(function($roles) {
                            return 'roleDtRow' . $roles->id;
                        })
                        ->make(true);
    }
}
