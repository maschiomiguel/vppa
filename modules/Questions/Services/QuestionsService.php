<?php

namespace Modules\Questions\Services;

use Modules\Questions\Models\Question;
use Modules\Questions\Models\QuestionCategory;

class QuestionsService
{
    public function hasQuestions()
    {
        $count = Question::where('active', 1)->count();
        return $count;
    }

    public function getQuestions()
    {
        return Question::where('active', 1)->orderBy('order')->get();
    }
}
