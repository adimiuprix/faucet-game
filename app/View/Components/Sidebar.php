<?php

namespace App\View\Components;

use App\Models\Currency;
use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * @var Collection<int, Currency>
     */
    public $currencies;

    public $telegram_channel;

    public $telegram_group;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->currencies = Currency::where('status', 'active')
            ->orderBy('id')
            ->get();

        $this->telegram_channel = Setting::telegramChannel();

        $this->telegram_group = Setting::telegramGroup();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
