<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\ContentCategory;

use MoonShine\Exceptions\FieldException;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<ContentCategory>
 */
class ContentCategoryResource extends ModelResource
{
    protected string $model = ContentCategory::class;

    protected string $title = 'ContentCategories';

    public string $column = 'name';

    /**
     * @return list<MoonShineComponent|Field>
     * @throws FieldException
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make(__('moonshine::ui.fields.name'), 'name'),
                Text::make(__('moonshine::ui.fields.slug'), 'slug')->readonly(),
            ]),
        ];
    }

    /**
     * @param ContentCategory $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
