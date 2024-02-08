<?php

namespace App\Presenters;

use Nette;
use Nette\Application\BadRequestException;

final class ArticlePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private readonly Nette\Database\Explorer $database,
    ){
        parent::__construct();
    }

    /**
     * Render selected article
     * @throws BadRequestException
     */
    public function renderShow(int $articleId): void {
        $this->getTemplate()->article = $this->database
            ->table('article')
            ->get($articleId);
        if (!$this->getTemplate()->article) {
            $this->error('Article not found');
        }
    }

}