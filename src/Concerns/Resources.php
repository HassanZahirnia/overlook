<?php

namespace Awcodes\Overlook\Concerns;

use Closure;

trait Resources
{
    protected array|Closure|null $includes = null;

    protected array|Closure|null $excludes = null;

    public function includeResources(array|Closure $resources): static
    {
        $this->includes = $resources;

        return $this;
    }

    public function excludeResources(array|Closure $resources): static
    {
        $this->excludes = $resources;

        return $this;
    }

    public function getIncludes(): array
    {
        return $this->evaluate($this->includes) ?? [];
    }

    public function getExcludes(): array
    {
        return $this->evaluate($this->excludes) ?? [];
    }
}