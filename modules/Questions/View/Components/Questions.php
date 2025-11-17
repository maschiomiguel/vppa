<?php

namespace Modules\Questions\View\Components;

use Illuminate\View\Component;
use Modules\Questions\Services\QuestionsService;

class Questions extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(private QuestionsService $questions)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('modules-questions::components.questions', [
            'questions' => $this->questions->getQuestions(),
        ]);
    }
}
