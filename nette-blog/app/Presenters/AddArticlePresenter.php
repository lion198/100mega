<?php
namespace App\Presenters;

use App\Model\User;
use Nette;
use Nette\Application\UI\Form;

final class AddArticlePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private readonly Nette\Database\Explorer $database,
    ) {
        parent::__construct();
    }

    protected function createComponentArticleForm(): Form
    {
        $form = new Form;

        $form->addText('title', 'Title:')
            ->setRequired();

        $form->addTextArea('content', 'Content:')
            ->setRequired();

        $form->addMultiUpload('image', 'Image:');
//            ->addRule(Form::IMAGE, 'Import image!'); // validation

        $form->addSubmit('send', 'Add article');
        $form->onSuccess[] = [$this, 'articleFormSucceeded'];

        return $form;
    }

    public function articleFormSucceeded(Form $form, array $values): void
    {
        /** @var User $user */
        $user = $this->getUser()->getIdentity();
        $articleData = [
            'title' => $values['title'],
            'content' => $values['content'],
            'user_id' => $user->getId(),
            'time' => time(),
        ];

        $article = $this->database->table('article')->insert($articleData);

        foreach ($values['image'] as $uploadedImage) {
            if ($uploadedImage->hasFile()) {
                $base64Data = base64_encode(file_get_contents($uploadedImage->getTemporaryFile()));
                $this->database->table('photoArticle')->insert([
                    'article_id' => $article->id,
                    'data' => $base64Data,
                ]);
            }
        }
        $this->sendEmail($user);
        $this->redirect('this');
    }
    /** Function send email to admin  - need config SMTP */
    private function sendEmail(User $user){
//        $mailer = new \Mailer();
//        $message = new Message();
//        $message->setFrom('sender@example.com')
//            ->addTo('admin@example.com')
//            ->setSubject($user->getLogin(). ' Add article')
//            ->setBody($user->getLogin(). ' Add article');
//        try {
//            $mailer->send($message);
//        } catch (Nette\Security\AuthenticationException $e) {
//            $this->error('Send mail failed');
//        }
    }
}