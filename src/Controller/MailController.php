<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailController extends AbstractController
{
    /**
     * @Route("/email/validationcommand", methods={"POST"})
     */
    public function sendEmail(MailerInterface $mailer, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $email = (new TemplatedEmail())
            ->from('ubereat@gmail.com')
            ->to($data['userMail'])
            ->subject('Your command')
            ->htmlTemplate('email/validation_command_user.html.twig')
            ->context([
                'commandDishes' => $data['commandDishes'],
                'deliveryDate' => $data['deliveryDate']
            ]);

        $mailer->send($email);

        return new Response(
            Response::HTTP_OK
        );
    }
}
