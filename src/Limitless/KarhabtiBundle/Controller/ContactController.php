<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Mail;
use Limitless\KarhabtiBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function mailAction(Request $request)
    {
        $mail = new Mail();
        $form=$this->createForm(MailType::class,$mail);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $message= \Swift_Message::newInstance()
                ->setSubject('Contact')
                ->setFrom($mail->getEmail())
                ->setTo('karhabti210@gmail.com')
                ->setBody(
                    $this->renderView(
                        '@LimitlessKarhabti/Contact/email.html.twig',
                        array('text'=> $mail->getText(),'mail'=>$mail->getEmail(),'Username'=>$mail->getNom())
                    ), 'text/html'
                );
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('limitless_karhabti_accuse_mail'));
        }
        return $this->render('@LimitlessKarhabti/Contact/form.html.twig',array('form'=>$form->createView()));
    }

    public function successAction()
    {
        //return new Response("emil envoyé avec succés , L'admin se chargera de vous répondre le plus proche possible");
        return $this->render('@LimitlessKarhabti/Contact/sucess.html.twig');

    }
}
