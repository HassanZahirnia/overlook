<?php

namespace Awcodes\Overlook\Concerns;

use Closure;
use Composer\InstalledVersions;

trait Versions
{
    protected array $items = [];

    protected bool $shouldRegisterNavigationView = true;

    public function addItem(string $name, string|Closure $version = ''): static
    {
        if ($version instanceof Closure) {
            $version = $version();
        }

        $this->items[str()->slug($name)] = [
            'name' => $name,
            'version' => $version,
        ];

        return $this;
    }

    public function getItems(): array
    {
        $this->items = array_merge([
            'laravel' => [
                'name' => 'Laravel',
                'version' => InstalledVersions::getPrettyVersion('laravel/framework'),
            ],
            'filament' => [
                'name' => 'Filament',
                'version' => InstalledVersions::getPrettyVersion('filament/filament'),
            ],
            'php' => [
                'name' => 'PHP',
                'version' => PHP_VERSION,
            ],
        ], $this->items);

        return $this->evaluate($this->items);
    }

    public function hasNavigationView(): bool
    {
        return $this->evaluate($this->shouldRegisterNavigationView);
    }

    public function registerNavigationView(bool|Closure $condition): static
    {
        $this->shouldRegisterNavigationView = $condition;

        return $this;
    }
}