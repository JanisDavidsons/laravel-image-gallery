<?php

namespace App\Http\Controllers;

use App\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::query()->findOrFail($user);
        return view(
            'profiles/index',
            [
                'user' => $user
            ]
        );
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles/edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'url' => 'url',
                'image' => ''
            ]
        );

        if (request('image')) {
            $imagePath = request()->file('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(500, 500);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(
            array_merge(
                $data,
                $imageArray ?? []
            )
        );

        return redirect("/profile/{$user->id}");
    }
}
