<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class Thumbnail extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label,
        public ?string $value = null,
        public string $type = 'file',
        public string $help = '',
    ) {

    }

    public function isImage(): bool
    {
        return str_starts_with(Storage::mimeType($this->value), 'image/');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.thumbnail');
    }
}
