<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $userId = auth()->id();

        $likedProducts = DB::table('products as p')
            ->join('liked_products as lp', 'p.id', '=', 'lp.product_id')
            ->join(DB::raw('(SELECT product_id, MIN(id) as min_id FROM photos GROUP BY product_id) as min_photos'), 'p.id', '=', 'min_photos.product_id')
            ->join('photos as ph', 'min_photos.min_id', '=', 'ph.id')
            ->select('p.*', 'ph.source')
            ->where('lp.user_id', $userId)
            ->get();
        return view('profile.edit', ['user' => $request->user(), 'data' => $likedProducts]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
