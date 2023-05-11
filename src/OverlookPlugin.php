<?php

namespace Awcodes\Overlook;

use Closure;
use Composer\InstalledVersions;
use Filament\Context;
use Filament\Contracts\Plugin;
use Filament\Support\Assets\Css;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\View\View;
use Livewire\Livewire;

class OverlookPlugin implements Plugin
{
    use EvaluatesClosures;
    use Concerns\Versions;
    use Concerns\Resources;

    protected static string $name = 'overlook';

    protected bool $disableCss = false;

    public function getId(): string
    {
        return static::$name;
    }

    public function register(Context $context): void
    {
        if (! $this->shouldDisableCss()) {
            FilamentAsset::register([
                Css::make(static::$name, __DIR__ . '/../resources/dist/' . static::$name . '.css'),
            ], static::$name);
        }
    }

    public function boot(Context $context): void
    {
        Livewire::component('resources-widget', Widgets\ResourcesWidget::class);
        Livewire::component('versions-widget', Widgets\VersionsWidget::class);

        if ($this->hasNavigationView()) {
            $context->renderHook(
                name: 'sidebar.end',
                callback: fn(): View => view('overlook::versions.sidebar', ['items' => $this->getItems()])
            );
        }
    }

    public function disableCss(bool $condition = true): static
    {
        $this->disableCss = $condition;

        return $this;
    }

    public function shouldDisableCSs(): bool
    {
        return $this->disableCss;
    }
}