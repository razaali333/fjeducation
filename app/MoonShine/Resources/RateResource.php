<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Enum\RateCurrencyLabel;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rate;

use MoonShine\Fields\Enum;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Rate>
 */
class RateResource extends ModelResource
{
    protected string $model = Rate::class;
    protected string $column = 'title';

    public function title(): string
    {
        return __('moonshine::ui.titles.rates');
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->hideOnAll(),
                Text::make(__('moonshine::ui.fields.title'), 'title')->sortable(),
                Textarea::make(__('moonshine::ui.fields.description'), 'description'),
                Number::make(__('moonshine::ui.fields.price'), 'price')->sortable(),
                Enum::make(__('moonshine::ui.fields.currency'), 'currency_label')->attach(RateCurrencyLabel::class),
                HasMany::make(__('moonshine::ui.fields.items'), 'items', resource: new RateItemResource())->hideOnIndex()->creatable(),
                HasMany::make(__('moonshine::ui.fields.contents'), 'contents', resource: new ContentRateResource())->hideOnIndex()->creatable()->fields([
                    BelongsTo::make(__('moonshine::ui.fields.content'), 'content', resource: new ContentResource()),
                ]),
            ]),
        ];
    }

    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }

    /**
     * @param Rate $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
