<?php

namespace Orian\Framework\Support;

class Manifest
{
    public function __construct(
        protected string $path
    ) {}

    public function all(): array
    {
        if (! file_exists($this->path)) {
            return [
                'pages' => [],
                'modules' => [],
                'resources' => [],
                'schemas' => [],
            ];
        }

        return json_decode(file_get_contents($this->path), true) ?? [];
    }

    public function pages(): array
    {
        return $this->all()['pages'] ?? [];
    }

    public function resources(): array
    {
        return $this->all()['resources'] ?? [];
    }

    public function schemas(): array
    {
        return $this->all()['schemas'] ?? [];
    }
}