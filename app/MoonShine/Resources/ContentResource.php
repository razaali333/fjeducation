<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Content;

use MoonShine\Enums\PageType;
use MoonShine\Fields\File;
use MoonShine\Fields\Image;
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
 * @extends ModelResource<Content>
 */
class ContentResource extends ModelResource
{
    protected string $model = Content::class;
    public string $column = 'title';
    protected bool $isAsync = true;
    protected bool $isPrecognitive = true;
    protected ?PageType $redirectAfterSave = PageType::INDEX;

    public function title(): string
    {
        return __('moonshine::ui.titles.contents');
    }

    public function getActiveActions(): array
    {
        return ['create', 'update', 'delete', 'massDelete'];
    }

    /**
     * @param Content $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
