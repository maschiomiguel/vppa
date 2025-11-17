<?php

declare(strict_types=1);

namespace Modules\PageHome\Orchid\Screens;

use Modules\PageHome\Models\PageHome;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\TextArea;
use Illuminate\Http\Request;
use App\Modules\ModulesScreen;
use App\Orchid\Fields\TinyMCE;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Upload;

class PageHomeEditScreen extends ModulesScreen
{
    protected $model;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(PageHome $model): iterable
    {
        checkAuth('platform.pageshome.edit');
        $this->model = $model->firstOrNew();

        return [
            'model' => $this->model,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->model->exists ? "Editando conteúdo e SEO" : "Criando conteúdo e SEO";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
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
        $language_fields = [];

        foreach (languages()->languages() as $language) {
            $locale = $language->locale;

            $fields = [   

                Layout::rows([
                    Input::make("model.$locale.call_link")
                        ->type('text')
                        ->title('Link do vídeo da seção hero')
                        ->value($this->model->translate($locale)?->call_link)
                        ->placeholder('Link do vídeo da seção hero')
                        ->help('O link deve ser do embeddable, como do YouTube ou Vimeo. Ex.: https://www.youtube.com/embed/dQw4w9WgXcQ'),

                ])->title('Hero Section'),

                Layout::rows([

                    TextArea::make("model.$locale.title_1")
                        ->type('text')
                        ->title("Título da seção de números")
                        ->value($this->model->translate($locale)?->title_1)
                        ->height(75),

                    TinyMCE::make("model.$locale.text")
                        ->title("Texto da seção de números")
                        ->value($this->model->translate($locale)?->text),

                    Matrix::make("model.$locale.count_up")
                        ->title('Contadores')
                        ->columns([
                            'Prefixo (+ de)' => 'num_prefix',
                            'Valor final' => 'num_target',
                            'Sufixo junto ao valor' => 'num_suffix',
                            'Unidade (%, pessoas)' => 'num_unity',
                            'Frase abaixo' => 'num_subject',
                        ])
                        ->value($this->model->translate($locale)?->count_up ?: [[]])
                        ->maxRows(3),

                ])->title("Números"),

                Layout::rows([
                    TextArea::make("model.$locale.keywords")
                        ->title('Palavras-chave (Google)')
                        ->placeholder('Palavras-chave (Google)')
                        ->value($this->model->translate($locale)?->keywords)
                        ->help("Separe os valores usando vírgulas. Exemplo: nome do seu produto, nome do seu serviço")
                        ->popover('Palavras ou frases que descrevem seu produto ou serviço selecionadas para determinar quando e onde seu anúncio pode ser exibido. As palavras-chave que você escolhe são usadas para exibir seus anúncios para as pessoas.'),

                    TextArea::make("model.$locale.description")
                        ->title('Description (Google)')
                        ->placeholder('Description (Google)')
                        ->value($this->model->translate($locale)?->description)
                        ->help("Esse texto é exibido pelos resultados da pesquisa feita")
                        ->maxlength(160)
                        ->popover('Meta Description é o pequeno texto que aparece logo abaixo do título e do link de uma página quando se faz uma pesquisa no Google.'),
                ])->title("SEO (Google)"),
            ];

            $language_fields[$language->name] = $fields;
        }

        $languages_panel = count($language_fields) > 1 ? Layout::tabs($language_fields) : array_values($language_fields)[0];

        return [
            $languages_panel,
        ];
    }

    public function save(PageHome $model, Request $request)
    {
        checkAuth('platform.pageshome.edit');
        $model = $model->firstOrNew();
        return parent::createOrUpdate($model, 'platform.pageshome.edit', []);
    }

    public static function routes()
    {
        parent::routeSingle('página home', 'pageshome');
    }

    public static function permissions()
    {
        return parent::editPermission('página home', 'pageshome');
    }
}
