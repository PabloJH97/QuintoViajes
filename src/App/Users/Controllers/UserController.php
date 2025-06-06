<?php

namespace App\Users\Controllers;

use App\Core\Controllers\Controller;
use Domain\Roles\Models\Role;
use Domain\Users\Actions\UserDestroyAction;
use Domain\Users\Actions\UserIndexAction;
use Domain\Users\Actions\UserStoreAction;
use Domain\Users\Actions\UserUpdateAction;
use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('users.view');
        return Inertia::render('users/Index');
    }

    public function create()
    {
        Gate::authorize('users.create');
        $role=Role::all();

        $arrayPermissions=[];
        foreach($role as $rol){
            foreach($rol->permissions as $perm){
                array_push($arrayPermissions, [$rol->name, $perm->name]);
            }
        }
        return Inertia::render('users/Create', ['arrayPermissions'=>$arrayPermissions]);
    }

    public function history(?string $user_id=null)
    {
        $history=[];
        $media=[];
        $user=Auth::user();
        if($user_id){
            $user=User::find($user_id);
        }
        $tickets=$user->tickets->all();
        foreach($tickets as $ticket){
            array_push($media, $ticket->flight->plane->getFirstMediaUrl('images'));
            array_push($history, $ticket);
        }
        $history=collect($history)->sortBy('created_at')->toArray();
        $keys=array_keys($history);
        foreach($keys as $key){
            $history[$key]=[$history[$key], $media[$key]];
        }
        $history=array_values($history);
        return Inertia::render('users/History', ['history'=>$history]);
    }

    public function store(Request $request, UserStoreAction $action)
    {
        Gate::authorize('users.create');
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $action($validator->validated(), $request->permissions);

        return redirect()->route('users.index')
            ->with('success', __('messages.users.created'));
    }

    public function edit(Request $request, User $user)
    {
        Gate::authorize('users.edit');
        $role=Role::all();

        $arrayPermissions=[];
        foreach($role as $rol){
            foreach($rol->permissions as $perm){
                array_push($arrayPermissions, [$rol->name, $perm->name]);
            }
        }
        return Inertia::render('users/Edit', [
            'user' => $user,
            'page' => $request->query('page'),
            'perPage' => $request->query('perPage'),
            'arrayPermissions'=>$arrayPermissions,
        ]);
    }

    public function update(Request $request, User $user, UserUpdateAction $action)
    {
        Gate::authorize('users.edit');
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $action($user, $validator->validated(), $request->permissions);

        $redirectUrl = route('users.index');

        // Añadir parámetros de página a la redirección si existen
        if ($request->has('page')) {
            $redirectUrl .= "?page=" . $request->query('page');
            if ($request->has('perPage')) {
                $redirectUrl .= "&per_page=" . $request->query('perPage');
            }
        }

        return redirect($redirectUrl)
            ->with('success', __('messages.users.updated'));
    }

    public function destroy(User $user, UserDestroyAction $action)
    {
        Gate::authorize('users.delete');
        $action($user);

        return redirect()->route('users.index')
            ->with('success', __('messages.users.deleted'));
    }
}
