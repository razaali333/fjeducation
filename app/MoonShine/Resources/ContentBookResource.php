<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Content;
use App\Models\ContentCategory;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use MoonShine\Enums\PageType;
use MoonShine\Exceptions\FieldException;
use MoonShine\Fields\File;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Content>
 */
class ContentBookResource extends ContentResource
{
    protected string $model = Content::class;

    public function title(): string
    {
        return __('moonshine::ui.titles.books');
    }

    /**
     * @return list<MoonShineComponent|Field>
     * @throws FieldException
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->hideOnAll(),
                Select::make(__('moonshine::ui.fields.category'), 'content_category_id')
                    ->options(function () {
                        $content = ContentCategory::query()->where('slug', '=', 'book')->first();

                        $data[$content->id] = $content->name;

                        return $data;
                    })
                    ->badge()
                    ->hideOnAll()
                    ->showOnCreate()
                    ->readonly()
                    ->required(),
                Text::make(__('moonshine::ui.fields.title'), 'title')
                    ->required(),
                Image::make(__('moonshine::ui.fields.cover'), 'cover')
                    ->disk('public'),
                Textarea::make(__('moonshine::ui.fields.description'), 'description')
                    ->required(),

                HasMany::make(__('moonshine::ui.fields.rates'), 'rates', resource: new ContentRateResource())
                    ->hideOnIndex()
                    ->creatable()
                    ->fields([
                        BelongsTo::make(__('moonshine::ui.fields.rate'), 'rate', resource: new RateResource()),
                    ]),
                File::make(__('moonshine::ui.fields.book'), 'file')->disk('public')
                    ->hideOnIndex()
                    ->allowedExtensions(['pdf', 'txt', 'docx', 'doc', 'odt'])
            ]),
        ];
    }

    public function query(): Builder
    {
        return parent::query()->whereHas('contentCategory', function ($query) {
            return $query->where('slug', '=', 'book');
        });
    }

    /**
     * @param Content $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'file' => ['required', 'file', 'mimes:pdf,txt,doc,docx,odt'],
        ];
    }
}
