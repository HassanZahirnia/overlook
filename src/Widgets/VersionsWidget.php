<?php

namespace Awcodes\Overlook\Widgets;

use Exception;
use Filament\Widgets\Widget;

class VersionsWidget extends Widget
{
    protected static string $view = 'overlook::versions.widget';

    protected int | string | array $columnSpan = 'full';

    public array $items = [];

    /**
     * @throws Exception
     */
    public function mount(): void
    {
        $this->items = filament('overlook')->getItems();
    }
}
