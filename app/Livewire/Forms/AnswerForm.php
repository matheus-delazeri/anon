<?php

namespace App\Livewire\Forms;

use App\Enums\QuestionStatusEnum;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class AnswerForm extends Component
{
    use Toastable;

    public Question $question;
    public string $answer = "";

    protected $listeners = [
        'room-updated' => 'mount'
    ];

    protected array $rules = [
        'answer' => 'required|string|max:255'
    ];

    public function mount(Question $question)
    {
        $this->question = $question;
    }

    public function save()
    {
        $this->validate();

        $this->question->answer = $this->answer;
        $this->question->status = QuestionStatusEnum::ANSWERED;
        $this->question->save();

        $this->dispatch('show-room', $this->question->room->id);
        $this->success('Question successfully answered!');
    }

    public function render()
    {
        return view('livewire.pages.room.answer');
    }
}
