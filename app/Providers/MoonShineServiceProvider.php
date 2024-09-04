<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\ContentBookResource;
use App\MoonShine\Resources\ContentCategoryResource;
use App\MoonShine\Resources\ContentRateResource;
use App\MoonShine\Resources\ContentVideoResource;
use App\MoonShine\Resources\RateItemResource;
use App\MoonShine\Resources\RateResource;
use App\MoonShine\Resources\TransactionResource;
use App\MoonShine\Resources\UserResource;
use MoonShine\Menu\MenuGroup;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuItem;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Pages\Page;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [
            new RateItemResource(),
            new ContentCategoryResource(),
            new ContentRateResource(),
        ];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function menu(): array
    {
        return [
            MenuItem::make(
                static fn() => __('moonshine::ui.titles.users'),
                new UserResource(),
                'heroicons.outline.users'
            ),
            MenuItem::make(
                static fn() => __('moonshine::ui.titles.transactions'),
                new TransactionResource(),
                'heroicons.outline.clipboard-document-list'
            ),
            MenuItem::make(
                static fn() => __('moonshine::ui.titles.rates'),
                new RateResource(),
                'heroicons.outline.currency-dollar'
            ),
            MenuGroup::make(__('moonshine::ui.titles.contents'), [
                MenuItem::make(
                    static fn() => __('moonshine::ui.titles.books'),
                    new ContentBookResource(),
                    'heroicons.outline.book-open'
                ),
                MenuItem::make(
                    static fn() => __('moonshine::ui.titles.videos'),
                    new ContentVideoResource(),
                    'heroicons.outline.video-camera'
                ),
            ], 'heroicons.outline.inbox-stack')
        ];
    }

    /**
     * @return array
     */
    protected function theme(): array
    {
        return [];
    }
}
