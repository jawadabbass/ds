<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Html;
use Form;
use DataTables;
use Illuminate\Support\Str;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.role.index');
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
        $roles = Role::select(['roles.id', 'roles.role_title', 'roles.role_group', 'roles.created_at', 'roles.updated_at']);
        return Datatables::of($roles)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('role_title') && !empty($request->role_title)) {
                                $query->where('roles.role_title', 'like', "%{$request->get('role_title')}%");
                            }
                        })
                        ->addColumn('role_title', function ($roles) {
                            return Str::limit($roles->role_title, 100, '...');
                        })
                        ->addColumn('role_group', function ($roles) {
                            return Str::limit($roles->role_group, 100, '...');
                        })
                        ->addColumn('action', function ($roles) {
                            return '<div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" href="' . route('admin.edit.role', ['id' => $roles->id]) . '"><i class="nav-icon fas fa-edit"></i> Edit</a>
                                <div class="dropdown-divider"></div>
                              </div>
                          </div>';
                        })
                        ->rawColumns(['role_title', 'action'])
                        ->setRowId(function($roles) {
                            return 'roleDtRow' . $roles->id;
                        })
                        ->make(true);
    }
}
