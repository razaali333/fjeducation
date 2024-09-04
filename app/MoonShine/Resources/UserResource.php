<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Date;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<User>
 */
class UserResource extends ModelResource
{
//   echo 'work';exit;
    protected string $model = User::class;
    protected string $column = 'email';

    public function title(): string
    {
        return __('moonshine::ui.titles.users');
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->hideOnAll(),
                Checkbox::make(__('moonshine::ui.fields.is_admin'), 'is_admin'),
                Text::make(__('moonshine::ui.fields.name'), 'name'),
                Text::make(__('moonshine::ui.fields.email'), 'email')->sortable(),
                Phone::make(__('moonshine::ui.fields.phone'), 'phone')->mask('+7 999 999-99-99'),
                Date::make(__('moonshine::ui.fields.created_at'), 'created_at')->withTime()->hideOnAll()->showOnIndex()->showOnDetail(),
            ]),
        ];
    }

    /**
     * @param User $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
