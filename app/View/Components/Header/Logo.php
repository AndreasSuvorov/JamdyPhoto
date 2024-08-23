<?php

namespace App\View\Components\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type = 'default',
        public string $size = 'md'
    )
    {
        //
    }

    private function getLogoUrl(): string
    {
        $logo = asset('images/Logo svg/2.svg');
        // Get the Logo url
        if ($this->type == 'white') {
            $logo = asset('images/Logo svg/3.svg');
        }

        return $logo;
    }

    private function getLogoSize(): string
    {
        // Make the logo size sm md lg xl
        $size = '142px';
        if ($this->size == 'sm') {
            $size = '280px';
        } elseif ($this->size == 'lg') {
            $size = '360px';
        } elseif ($this->size == 'xl') {
            $size = '420px';
        }

        return $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.header.logo', [
            'logo' => $this->getLogoUrl(),
            'logo_size' => $this->getLogoSize()
        ]);
    }
}
