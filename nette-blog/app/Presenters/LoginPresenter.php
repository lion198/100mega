<?php

namespace App\Presenters;

use App\Model\User;
use Nette;
use Nette\Application\AbortException;
use Nette\Application\UI\Form;
use stdClass;

final class LoginPresenter extends Nette\Application\UI\Presenter
{
    public function __construct(

        private readonly Nette\Database\Explorer $database,
        ) {
        parent::__construct();
    }
    /** create login form */
    protected function createComponentSignInForm(): Form
    {
        $form = new Form;
        $form->addText('login', 'Login')
            ->setRequired('Entry login');

        $form->addPassword('password', 'Password:')
            ->setRequired('Entry password');

        $form->addSubmit('send', 'Login');

        $form->onSuccess[] = $this->signInFormSucceeded(...);
        return $form;
    }

    /**
     * Login action
     * @throws AbortException
     */
    private function signInFormSucceeded(Form $form, stdClass $data): void
    {
        $login = $data->login;
        $password = $data->password;

        try {
            $user = $this->database->table('user')->where('login', $login)->fetch();
            if ($user && password_verify($password, $user->password)) {
                $userObject = User::dbToObject($user);
                $this->getUser()->login($userObject);
                $this->redirect('Home:');
            } else {
                $form['send']->addError('Bad login or password');
            }
        } catch (Nette\Security\AuthenticationException $e) {
            $this->error('Someting is wrong');
        }
    }

    /**
     * Logout action
     * @throws AbortException
     */
    public function actionOut(): void {
        $this->getUser()->logout();
        $this->flashMessage('Logout');
        $this->redirect('Home:');
    }
}