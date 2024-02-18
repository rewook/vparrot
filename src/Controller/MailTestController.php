<?php



namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class MailTestController extends AbstractController
{

    #[Route('/testmail', name: 'app_test_email')]
    public function sendTestEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('your@email.com')
            ->to('recipient@email.com')
            ->subject('Test Email')
            ->text('This is a test email from Symfony.');

        $mailer->send($email);

        return new Response('Test email sent successfully!');
    }
}

