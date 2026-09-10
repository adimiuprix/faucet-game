<?php

namespace App\View\Components;

use Closure;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Topbar extends Component
{
    /**
     * @var string|null
     */
    public string|null $telegramGroup;
    
    /**
     * @var string|null
     */
    public string|null $telegramChannel;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->telegramGroup = Setting::telegramGroup();
        $this->telegramChannel = Setting::telegramChannel();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.topbar');
    }
}
