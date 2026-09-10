<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['key', 'value'])]
class Setting extends Model
{
    public static function get(string $key, $default = null){
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function sitename(){
        return static::where('key', 'sitename')->value('value');
    }

    public static function keywords(){
        return static::where('key', 'keywords')->value('value');
    }

    public static function description(){
        return static::where('key', 'description')->value('value');
    }

    public static function commission(){
        return static::where('key', 'commission')->value('value');
    }

    public static function energyCost(){
        return (int) (static::where('key', 'energy_cost')->value('value'));
    }

    public static function faucetCooldown(){
        return (int) (static::where('key', 'faucet_cooldown')->value('value'));
    }

    public static function faucetChance(){
        return (int) (static::where('key', 'faucet_chance')->value('value'));
    }

    public static function telegramGroup(){
        return static::where('key', 'telegram_group')->value('value');
    }

    public static function telegramChannel(){
        return static::where('key', 'telegram_channel')->value('value');
    }
}
