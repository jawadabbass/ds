<?php

namespace App\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PermissionsClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:clear {--roles=*} {--tables=*} {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear permissions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $options = $this->options();

        DB::transaction(function () use ($options) {
            $no_options = count($options['tables']) == 0 && !$options['all'];

            $roles_options = $options['roles'];
            $tables_options = $options['tables'];

            $old_roles = Role::whereIn('role_title', $roles_options)->get();

            if (in_array('permission_role', $tables_options) || $no_options) {
                $query = DB::table('roles_permissions');

                if (count($roles_options) > 0) {
                    $old_roles_id = $old_roles->pluck('id');
                    $query->whereIn('role_id', $old_roles_id)->delete();
                } else {
                    $query->delete();
                }
            }

            if (in_array('permissions', $tables_options) || $options['all'] || $no_options) {
                if (count($roles_options) > 0) {
                    Permission::whereHas('roles', function ($query) use ($roles_options) {
                        $query->whereIn('role_title', $roles_options);
                    })->delete();
                } else {
                    DB::table('roles_permissions')->delete();
                    Permission::query()->delete();
                }
            }

            if (in_array('roles', $tables_options) || $options['all'] || $no_options) {
                if (count($roles_options) > 0) {
                    Role::whereIn('role_title', $roles_options)->delete();
                } else {
                    DB::table('roles_permissions')->delete();
                    Role::query()->delete();
                }
            }
        });
    }
}
