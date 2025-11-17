<?php

namespace Modules\Questions\Models;

use App\Modules\ModulesModel;

class QuestionTranslation extends ModulesModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'question',
        'answer',
        'title',
        'title_1',
        'text',
        'text_1',
        'link',
        'link_1',
        'text_link',
        'text_link_1',
    ];
    
}
