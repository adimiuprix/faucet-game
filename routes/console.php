<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:reset-claim-chance')->daily();