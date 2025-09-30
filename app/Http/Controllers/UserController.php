<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends SearchableController
{
    const int MAX_ITEMS = 5;
    const array ROLES = ['ADMIN', 'USER'];

    #[\Override]
    function getQuery(): Builder
    {
        return User::orderBy('email');
    }

    #[\Override]
    function applyWhereToFilterByTerm(Builder $query, string $word): void
    {
        $query->orWhere('email', 'LIKE', "%{$word}%");
        $query->orWhere('name', 'LIKE', "%{$word}%");
        $query->orWhere('role', 'LIKE', "%{$word}%");
    }

    #[\Override]
    function find(string $code): Model
    {
        return $this->getQuery()->where('email', $code)->firstOrFail();
    }


    function list(ServerRequestInterface $request): View
    {
        Gate::authorize('list', User::class);

        $criteria = $this->prepareCriteria($request->getQueryParams());
        $query = $this->search($criteria);

        return view('users.list', [
            'criteria' => $criteria,
            'users' => $query->paginate(self::MAX_ITEMS),
        ]);
    }

    function view(string $userEmail): View
    {
        $user = $this->find($userEmail);

        Gate::authorize('view', $user);

        return view('users.view', [
            'user' => $user,
        ]);
    }

    function showCreateForm(): View
    {
        Gate::authorize('create', User::class);

        return view('users.create-form', [
            'roles' => self::ROLES,
        ]);
    }

    function create(ServerRequestInterface $request): RedirectResponse
    {
        Gate::authorize('create', User::class);

        $data = $request->getParsedBody();
        $user = new User();
        $user->fill($data);
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->save();

        return redirect(
            session()->get('bookmarks.users.create-form', route('users.list')),
        )
            ->with('status', "User {$user->email} was created");
    }

    function showUpdateForm(string $userEmail): View
    {
        $user = $this->find($userEmail);

        Gate::authorize('update', $user);

        return view('users.update-form', [
            'user' => $user,
            'roles' => self::ROLES,
        ]);
    }

    function update(
        ServerRequestInterface $request,
        string $userEmail,
    ): RedirectResponse {
        $user = $this->find($userEmail);

        Gate::authorize('update', $user);

        $data = $request->getParsedBody();
        $password = $data['password'] ?? null;
        unset($data['password']);
        $user->fill($data);
        if (Gate::check('updateRole', $user)) {
            $user->role = $data['role'];
        }
        if ($password !== null) {
            $user->password = $password;
        }
        $user->save();

        return redirect()
            ->route('users.view', [
                'user' => $user->email,
            ])
            ->with('status', "User {$user->email} was updated");
    }

    function delete(string $userEmail): RedirectResponse
    {
        $user = $this->find($userEmail);

        Gate::authorize('delete', $user);

        $user->delete();

        return redirect(
            session()->get('bookmarks.users.view', route('users.list')),
        )
            ->with('status', "User {$user->email} was deleted");
    }

    function selfView(): View
    {
        $user = Auth::user();

        // Needed for responding with 403
        Gate::authorize('selfView', $user);

        return view('users.selves.view', [
            'user' => $user,
        ]);
    }

    function showSelfUpdateForm(): View
    {
        $user = Auth::user();

        // Needed for responding with 403
        Gate::authorize('selfUpdate', $user);

        return view('users.selves.update-form', [
            'user' => $user,
        ]);
    }

    function selfUpdate(ServerRequestInterface $request): RedirectResponse
    {
        /** @var User */
        $user = Auth::user();

        // Needed for responding with 403
        Gate::authorize('selfUpdate', $user);

        $data = $request->getParsedBody();
        $password = $data['password'] ?? null;
        unset($data['password']);
        $user->fill($data);
        if ($password !== null) {
            $user->password = $password;
        }
        $user->save();

        return redirect(
            session()->get('bookmarks.users.selves.update-form', route('users.selves.view')),
        )
            ->with('status', "Your information was updated.");
    }
}
