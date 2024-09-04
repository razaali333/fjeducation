<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Content;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContentRate;

use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<ContentRate>
 */
class ContentRateResource extends ModelResource
{
    protected string $model = ContentRate::class;

    protected string $title = 'ContentRates';

    protected string $sortColumn = 'created_at';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make(),
                BelongsTo::make(__('moonshine::ui.fields.rate'), 'rate', resource: new RateResource()),
                BelongsTo::make(__('moonshine::ui.fields.content'), 'content', resource: new ContentResource()),
            ]),
        ];
    }



    public function getActiveActions(): array
    {
        return ['create', 'delete', 'massDelete'];
    }

    /**
     * @param ContentRate $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
