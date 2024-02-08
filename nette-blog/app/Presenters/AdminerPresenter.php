<?php
namespace App\Presenters;

use Nette\Application\UI\Presenter;

// add adminer to project
class AdminerPresenter extends Presenter
{
    public function renderDefault(): void
    {
        require __DIR__ . '/../../www/adminer-4.8.1.php';
    }
}