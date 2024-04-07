<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::all();
        return view('page.role.index', compact('roles'));
    }
        public function show(Role $role)
    {
        $users = $role->users()->get();
        return view('page.role.show', compact('role', 'users'));
    }


    public function create(): View
    {
        return view('role.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        Role::create($request->all());

        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role): View
    {
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

   
}
