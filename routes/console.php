<?php

use App\Document\Console\ReadDeclarationsQueued;
use App\Document\Services\ReadDeclarationService;
use App\Mailing\Console\MailingQueueRun;
use App\Mailing\Services\MailingQueueService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('mailing:run', function (MailingQueueService $mailingQueueService) {
    $command = new MailingQueueRun();
    $command->handle($mailingQueueService);
})->describe('Run mailing queue');

Artisan::command('declarations:read', function (ReadDeclarationService $readDeclarationService) {
    $command = new ReadDeclarationsQueued();
    $command->handle($readDeclarationService);
})->describe('Run mailing queue');
