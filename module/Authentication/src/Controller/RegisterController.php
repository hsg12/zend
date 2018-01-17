<?php

namespace Authentication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManagerInterface;
use Authentication\Form\RegisterForm;
use Application\Entity\User;
use Authentication\Service\ValidationServiceInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Crypt\Password\Bcrypt;

class RegisterController extends AbstractActionController
{
    private $entityManager;
    private $registerForm;
    private $validationService;
    private $ormAuthService;

    public function __construct(
        EntityManagerInterface $entityManager,
        RegisterForm $registerForm,
        ValidationServiceInterface $validationService,
        $ormAuthService
    ) {
        $this->entityManager      = $entityManager;
        $this->registerForm       = $registerForm;
        $this->validationService  = $validationService;
        $this->ormAuthService     = $ormAuthService;
    }

    public function indexAction()
    {
        $captchaMessage = '';

        if ($this->identity()) {
            return $this->redirect()->toRoute('home');
            die;
        }

        $user = new User();
        $form = $this->registerForm;

        $form->setHydrator(new DoctrineObject($this->entityManager));
        $form->bind($user);
        $form->setValidationGroup('csrf', 'name', 'email', 'password', 'confirmPassword');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            $captchaResult = $this->checkCaptcha($request->getPost('g-recaptcha-response'));
            $captchaResult = json_decode($captchaResult)->success;

            if (! $captchaResult) {
                $captchaMessage = 'Please click on the reCAPTCHA box';
            }

            if ($form->isValid() && $captchaResult) {
                $repository = $this->entityManager->getRepository(User::class);

                if ($this->validationService->isObjectExists($repository, $user->getName(), ['name'])) {
                    $nameExists = 'User with name ' . $user->getName() . ' exists already';
                    $form->get('name')->setMessages(['nameExists' => $nameExists]);
                    return new ViewModel(['form' => $form,]);
                }

                $cloneUser = clone $user; // to have not hashed password

                $hash = (new Bcrypt())->create($user->getPassword());
                $user->setPassword($hash);

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $this->entityManager->getRepository(User::class)->login($cloneUser, $this->ormAuthService);

                return $this->redirect()->toRoute('home');
            }
        }

        return new ViewModel([
            'form' => $form,
            'captchaMessage' => $captchaMessage,
        ]);
    }

    private function checkCaptcha($recaptcha)
    {
        $secret = '6LdUCUEUAAAAAPZ1AT8fw_Jz26Srg405tFzJBghJ';
        $url = "https://www.google.com/recaptcha/api/siteverify";

        $data = [
            'secret' => $secret,
            'response' => $recaptcha,
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        ];

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, $url);
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);

        return $response;
    }
}
