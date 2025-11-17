<?php

namespace Modules\Questions\Models;

use App\Modules\ModulesModel;
use App\Models\State;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Question extends ModulesModel implements TranslatableContract
{
    use Translatable;

    protected $table = 'questions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'order',
    ];

    public $translatedAttributes = [
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

    protected $sync = [
        'categories' => 'categories',
    ];

    public function getLogName()
    {
        return $this->name;
    }

    public static function getEntityNameSingular()
    {
        return 'FAQ';
    }

    public static function getEntityNamePlural()
    {
        return 'FAQs';
    }

    public static function getArticle()
    {
        return 'o';
    }

}
