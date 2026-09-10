<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['provider', 'site_key', 'secret_key'])]

class Captcha extends Model
{
    public function getSecretKey(): string
    {
        if ($this->provider == 'hcaptcha') {

        }

        return $this->secret_key;
    }

    public function getSiteKey(): string
    {
        if ($this->provider == 'hcaptcha') {

        }

        return $this->site_key;
    }
}
