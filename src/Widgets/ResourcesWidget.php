<?php

namespace Awcodes\Overlook\Widgets;

use Exception;
use Filament\Widgets\Widget;

class ResourcesWidget extends Widget
{
    protected static string $view = 'overlook::resources.widget';

    protected int | string | array $columnSpan = 'full';

    public array $data = [];

    protected array $excludes = [];

    protected array $includes = [];

    /**
     * @throws Exception
     */
    public function mount(): void
    {
        $this->data = $this->getData();
    }

    /**
     * @throws Exception
     */
    public function getData(): array
    {
        $plugin = filament('overlook');

        $rawResources = filled($plugin->getIncludes())
            ? $plugin->getIncludes()
            : filament()->getCurrentContext()->getResources();

        return collect($rawResources)->filter(function ($resource) use ($plugin) {
            return ! in_array($resource, $plugin->getExcludes());
        })->transform(function ($resource) {
            $res = app($resource);

            if ($res->canViewAny()) {
                return [
                    'name' => ucfirst($res->getPluralModelLabel()),
                    'count' => $res->getEloquentQuery()->count(),
                    'icon' => $res->getNavigationIcon(),
                    'url' => $res->getUrl('index'),
                ];
            }

            return null;
        })
            ->filter()
            ->sortBy('name')
            ->values()
            ->toArray();
    }
}
