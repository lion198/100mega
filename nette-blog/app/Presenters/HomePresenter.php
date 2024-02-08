<?php
namespace App\Presenters;

use App\Model\User;
use Nette;
use Nette\Application\AbortException;

final class HomePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private readonly Nette\Database\Explorer $database,
    ) {
        parent::__construct();
    }

    public function renderDefault(): void {
        /** @var User $user */
        $data = $this->getArticleList();
//        $data = Article::dbListToListObject($data);
        $this->getTemplate()->articleList = $data;
    }

    /**
     * Action sort data on table
     * @throws AbortException
     */
    public function actionSortData() : void {
        /** @var User $user */

        $order = $this->getParameter('sortOrder');
        $data = $this->getArticleList($order);
        $jsonData = [];
//        $articleList =  Article::dbListToListObject($data);
        foreach ($data as $article){
            $articleResult = new \stdClass();
            $articleResult->id = $article->id;
            $articleResult->time = $article->time;
            $articleResult->title = $article->title;
            $articleResult->content = $article->content;
            $articleResult->login = $article->login;
            $jsonData[] = $articleResult;
        }
        json_encode($jsonData);
        $this->sendJson(['articleList' => $jsonData]);
    }
    /** Article list sql selection */
    private function getArticleList($order = ''): Nette\Database\ResultSet {
        /** @var User $user */
        $user = $this->getUser()->getIdentity();
        $where = $user->getRole() == User::ROLE_ADMIN ? '': ' WHERE article.user_id = '. $user->getId();
        return  $this->database->query( 'SELECT article.*, user.login
                FROM article
                LEFT JOIN user ON article.user_id = user.id
                '. $where . '
                ORDER BY article.time ' . $order);
    }

}