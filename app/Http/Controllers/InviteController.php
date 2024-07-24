<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Room\Invite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toastable;

class InviteController extends Controller
{
    use Toastable;

    public function index(Request $request): RedirectResponse
    {
        if (!$request->has('hash')) {
            $this->error('Hash not provided.');
            return redirect('dashboard');
        }

        $hash = $request->get('hash');
        $invite = Invite::where('hash', $hash)->first();

        if (!$invite || $invite->isExpired()) {
            $this->error('Invalid or expired invite.');
            return redirect('dashboard');
        }

        $room = Room::find($invite->room_id);
        $user = Auth::user();

        if (!$room || !$user) {
            $this->error('Room or user not found.');
            return redirect('dashboard');
        }

        if ($room->users()->where('user_id', $user->id)->exists()) {
            $this->warning('This user already joined this room!');
            return redirect('dashboard');
        }

        $room->users()->attach([$user->id => ['role' => $invite->role_granted]]);

        $this->success(__('Successfully joined room!'));
        return redirect('dashboard');
    }
}
