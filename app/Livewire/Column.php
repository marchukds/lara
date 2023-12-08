<?php

namespace App\Livewire;

class Column
{
    public string $component = 'columns.column';
    public string $key;
    public string $label;

    public function __construct(string $key, string $label)
    {
        $this->key = $key;
        $this->label = $label;
    }

    public static function make(string $key, string $label)
    {
        return new static($key, $label);
    }

    public function component(string $component): static
    {
        $this->component = $component;
        return $this;
    }
}
