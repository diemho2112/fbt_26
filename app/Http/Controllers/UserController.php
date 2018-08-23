<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Auth;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->userRepository->update($user->id, $request->all());

        return redirect()->route('user.show', $user->id)->with('user', $user);
    }

    public function notifications()
    {
        return Auth::user()->unreadNotifications()->get()->toArray();
    }
}
