<?php

namespace App\Livewire;

use App\Enums\QuestionStatusEnum;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class Room extends Component
{
    use Toastable;

    protected $listeners = [
        'room-updated' => 'mount'
    ];

    public \App\Models\Room $room;
    public bool $settings = false;

    public function mount(\App\Models\Room $room)
    {
        $this->room = $room;
    }

    public function render()
    {
        return view('livewire.pages.room.view');
    }

    public function leave()
    {
        $this->room->participants()->detach(Auth::id());

        $this->success('Left room.');
        $this->redirectRoute('dashboard');
    }

    public function approve(Question $question)
    {
        $question->status = QuestionStatusEnum::APPROVED;
        $question->save();

        $this->success('Question approved!');
    }

    public function decline(Question $question)
    {
        $question->status = QuestionStatusEnum::DECLINED;
        $question->save();

        $this->success('Question declined!');
    }

    public function upvote(Question $question)
    {
        $userId = Auth::id();
        $vote = Question\Vote::where('question_id', $question->id)
            ->where('user_id', $userId)
            ->first();

        if ($vote) {
            if ($vote->increment === 1) {
                $vote->increment = 0;
                $this->warning('Vote dismissed.');
                $vote->save();

                return;
            }

            $vote->increment = 1;
            $vote->save();
        } else {
            Question\Vote::create([
                'question_id' => $question->id,
                'user_id' => $userId,
                'increment' => 1
            ]);
        }

        $this->success('Question upvoted!');
    }

    public function downvote(Question $question)
    {
        $userId = Auth::id();
        $vote = Question\Vote::where('question_id', $question->id)
            ->where('user_id', $userId)
            ->first();

        if ($vote) {
            if ($vote->increment === -1) {
                $vote->increment = 0;
                $this->warning('Vote dismissed.');
                $vote->save();

                return;
            }

            $vote->increment = -1;
            $vote->save();
        } else {
            Question\Vote::create([
                'question_id' => $question->id,
                'user_id' => $userId,
                'increment' => -1,
            ]);
        }

        $this->success('Question downvoted!');
    }
}
