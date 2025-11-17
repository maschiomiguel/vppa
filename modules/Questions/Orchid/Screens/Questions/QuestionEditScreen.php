<?php

declare(strict_types=1);

namespace Modules\Questions\Orchid\Screens\Questions;

use Modules\Questions\Models\Question;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use App\Modules\ModulesScreen;
use App\Orchid\Fields\TinyMCE;
use Modules\Questions\Models\QuestionCategory;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;

class QuestionEditScreen extends ModulesScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Question $model): iterable
    {
        $this->model = $model;

        return [
            'model' => $model,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->editScreenName($this->model, 'FAQ');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getReturnLink('platform.questions.list'),
            parent::getRemoveButton($this->model, $this->model->exists),
            parent::getSaveButton($this->model, true),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {

        foreach (languages()->languages() as $language) {
            $locale = $language->locale;

            $fields = [
                Layout::rows([
                    Switcher::make('model.active')
                        ->sendTrueOrFalse()
                        ->title("Ativo")
                        ->help("Se marcado, esse faq ficará visível ao acessar o site.")
                        ->checked($this->model->exists ? (bool)$this->model->active : true)
                        ->canSee($language->code == "pt"),

                    Input::make('model.name')
                        ->type('text')
                        ->title("Nome (Restrita)")
                        ->required()
                        ->maxlength(150)
                        ->popover('Esse nome não aparecerá no site, é apenas um controle interno.')
                        ->canSee($language->code == "pt"),

                    TextArea::make("model.$locale.question")
                        ->rows(3)
                        ->title('Pergunta')
                        ->placeholder('Pergunta')
                        ->value($this->model->translate($locale)?->question),

                    TinyMCE::make("model.$locale.answer")
                        ->type('text')
                        ->title('Resposta')
                        ->placeholder('Resposta')
                        ->value($this->model->translate($locale)?->answer),

                    // Upload::make('model.attachment')
                    //     ->groups("image_questions")
                    //     ->acceptedFiles("image/*")
                    //     ->multiple(true)
                    //     ->resizeWidth(1280)
                    //     ->resizeHeight(1280)
                    //     ->set('data-upload-compress', "1")
                    //     ->maxFileSize(2)
                    //     ->canSee($locale == 'pt-BR')
                    //     ->title("Imagens")
                    //     ->help(screens()->getImageHelp('banner-desktop'))
                    //     ->targetId(),
                ]),
            ];

            $language_fields[$language->name] = $fields;
        }

        $languages_panel = count($language_fields) > 1 ? Layout::tabs($language_fields) : array_values($language_fields)[0];

        return [
            $languages_panel,
        ];
    }

    public function save(Question $model, Request $request)
    {
        return parent::createOrUpdate($model, 'platform.questions.list', [
            'model.name' => 'required',
        ]);
    }

    public function remove(Question $model)
    {
        return parent::delete($model, 'platform.questions.list');
    }

    public function toogleField(Question $model)
    {
        return parent::toggleField($model);
    }

    public function sort()
    {
        return parent::sortModel(Question::class);
    }

    public static function routes()
    {
        parent::routeEdit('questions', 'questions');
        parent::routeCreate('questions', 'questions');
    }

    protected static function permissionSlug() : string
    {
        return 'questions';
    }
}
