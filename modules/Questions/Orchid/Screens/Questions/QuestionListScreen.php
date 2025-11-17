<?php

namespace Modules\Questions\Orchid\Screens\Questions;

use Modules\Questions\Models\Question;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\DropDown;
use App\Modules\ModulesScreen;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Support\Facades\Toast;

class QuestionListScreen extends ModulesScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        checkAuth('platform.questions.list');

        return [
            'lista' => Question::orderBy('order')
                ->paginate(777777),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Lista de FAQ';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            parent::getCreateLink('platform.questions.create'),
            parent::getRemoveSelectedButton(),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('lista', [
                TD::make()->sortable('questions'),
                TD::make('checkbox', CheckBox::make('select-all')->class("form-check-input select-all-report-checks"))->checkbox('questions'),
                TD::make("name", "Nome")->cantHide(),
                TD::make("active", "Ativo")->toggleActive('questions'),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (Question $model) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            parent::getEditButton($model, 'platform.questions.edit', true),
                            parent::getRemoveButton($model, true),
                        ])),
            ]),
        ];
    }

    public function remove(Question $model)
    {
        return parent::delete($model, 'platform.questions.list');
    }

    public function removeAll()
    {
        $ids = request()->input('select-all');
        $count = count($ids);

        foreach ($ids as $id) {
            $model = Question::where('id', $id);
            parent::delete($model->first(), '', true);
        }

        Toast::info(
            "$count perguntas apagadas"
        );

        return redirect()->route('platform.questions.list');
    }

    public static function routes()
    {
        parent::routeList('FAQ', 'questions');
    }

    public static function permissions()
    {
        return parent::crudPermissions('FAQ', 'questions');
    }

    protected static function permissionSlug() : string
    {
        return 'questions';
    }
}
