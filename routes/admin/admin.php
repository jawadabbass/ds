<?php

$role_permission_val = ['role_group'=>'admin', 'permission_group'=>'admin'];

Route::namespace('App\Http\Controllers\Admin\Auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(
        function () {
            Route::get('login', 'LoginController@showLoginForm')->middleware(['authAdminCheck'])->name('login');
            Route::post('login', 'LoginController@login')->name('post.login');
            Route::post('logout','LoginController@logout')->name('logout');
            Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            Route::get('password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
            Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
            Route::post('password/confirm', 'ConfirmPasswordController@confirm')->name('post.password.confirm');
            Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
            Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
            Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
        }
    );

Route::namespace('App\Http\Controllers\Admin')
    ->middleware(['authAdmin'])//, 'auth.role'
    ->prefix('admin')
    ->name('admin.')
    ->group(
        function ($role_permission_val) {
            Route::get('dashboard/', array_merge(
                ['uses'=>'DashboardController@index'],
                ['permission_title'=>'View Dashboard'],
                (array)$role_permission_val
            ))->name('dashboard');

            Route::get(
                'list_roles',
                array_merge(
                    ['uses'=>'RoleController@index'],
                    ['permission_title'=>'View All Roles'],
                    (array)$role_permission_val
                )
            )->name('list.roles');

            Route::get(
                'add_role',
                array_merge(
                    ['uses'=>'RoleController@create'],
                    ['permission_title'=>'Add Role'],
                    (array)$role_permission_val
                )
            )->name('add.role');

            Route::post(
                'store_role',
                array_merge(
                    ['uses'=>'RoleController@store'],
                    ['permission_title'=>'Store Role'],
                    (array)$role_permission_val
                )
            )->name('store.role');

            Route::get(
                'edit_role/{id}',
                array_merge(
                    ['uses'=>'RoleController@edit'],
                    ['permission_title'=>'Edit Role'],
                    (array)$role_permission_val
                )
            )->name('edit.role');

            Route::put(
                'update_role',
                array_merge(
                    ['uses'=>'RoleController@update'],
                    ['permission_title'=>'Update Role'],
                    (array)$role_permission_val
                )
            )->name('update.role');

            Route::delete(
                'delete_role',
                array_merge(
                    ['uses'=>'RoleController@destroy'],
                    ['permission_title'=>'Delete Role'],
                    (array)$role_permission_val
                )
            )->name('delete.role');

            Route::get(
                'fetch_roles',
                array_merge(
                    ['uses'=>'RoleController@fetch'],
                    ['permission_title'=>'Fetch Roles'],
                    (array)$role_permission_val
                )
            )->name('fetch.roles');

/***************************************************************************** */

            Route::get(
                'list.permissions',
                array_merge(
                    ['uses'=>'PermissionController@index'],
                    ['permission_title'=>'View Permissions'],
                    (array)$role_permission_val
                )
            )->name('list.permissions');

            Route::get(
                'add.permission',
                array_merge(
                    ['uses'=>'PermissionController@create'],
                    ['permission_title'=>'Add Permission'],
                    (array)$role_permission_val
                )
            )->name('add.permission');
        }
    );
