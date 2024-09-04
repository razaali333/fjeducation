<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Model;
use App\Models\RateItem;

use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<RateItem>
 */
class RateItemResource extends ModelResource
{
    protected string $model = RateItem::class;
    protected string $column = 'title';

    public function title(): string
    {
        return __('moonshine::ui.titles.items');
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->hideOnAll(),
                BelongsTo::make(__('moonshine::ui.fields.rate'), 'rate', Rate::class)->hideOnAll()->showOnCreate(),
                Text::make(__('moonshine::ui.fields.title'), 'title'),
                Checkbox::make(__('moonshine::ui.fields.checked'), 'is_checked'),
            ]),
        ];
    }

    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }

    /**
     * @param RateItem $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
