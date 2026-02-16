<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{

    #[Route('/calendar-main', name: 'calendarMain')]
    public function calendarMain(): Response
    {
            return $this->render('calendarMain.html.twig', [
                'title' => 'Calendar',
                'subTitle' => 'Components / Calendar',
                'multi_script' => "<script src='/assets/js/full-calendar.js'></script>
                                    <script src='/assets/js/flatpickr.js'></script>",
                
            ]);
    }

    #[Route('/chat-empty', name: 'chatEmpty')]
    public function chatEmpty(): Response
    {
            return $this->render('chatEmpty.html.twig', [
                'title' => 'Chat',
                'subTitle' => 'Components / Chat',
            ]);
    }
    
    #[Route('/chat-message', name: 'chatMessage')]
    public function chatMessage(): Response
    {
            return $this->render('chatMessage.html.twig', [
                'title' => 'Chat',
                'subTitle' => 'Chat',
            ]);
    }

    #[Route('/chat-profile', name: 'chatProfile')]
    public function chatProfile(): Response
    {
            return $this->render('chatProfile.html.twig', [
                'title' => 'Chat',
                'subTitle' => 'Chat',
            ]);
    }

    #[Route('/email', name: 'email')]
    public function email(): Response
    {
            return $this->render('email.html.twig', [
                'title' => 'Email',
                'subTitle' => 'Components / Email',
            ]);
    }

    #[Route('/faq', name: 'faq')]
    public function faq(): Response
    {
            return $this->render('faq.html.twig', [
                'title' => 'Faq',
                'subTitle' => 'Faq',
            ]);
    }

    #[Route('/gallery', name: 'gallery')]
    public function gallery(): Response
    {
            return $this->render('gallery.html.twig', [
                'title' => 'Gallery',
                'subTitle' => 'Gallery',
            ]);
    }

    #[Route('/image-upload', name: 'imageUpload')]
    public function imageUpload(): Response
    {
            return $this->render('imageUpload.html.twig', [
                'title' => 'forms',
                'subTitle' => 'forms',
            ]);
    }

    #[Route('/kanban', name: 'kanban')]
    public function kanban(): Response
    {
            return $this->render('kanban.html.twig', [
                'title' => 'Kanban',
                'subTitle' => 'Kanban',
            ]);
    }

    #[Route('/page-error', name: 'pageError')]
    public function pageError(): Response
    {
            return $this->render('pageError.html.twig', [
                'title' => '404',
                'subTitle' => '404',
            ]);
    }

    #[Route('/pricing', name: 'pricing')]
    public function pricing(): Response
    {
            return $this->render('pricing.html.twig', [
                'title' => 'Pricing',
                'subTitle' => 'Pricing',
            ]);
    }

    #[Route('/starred', name: 'starred')]
    public function starred(): Response
    {
            return $this->render('starred.html.twig', [
                'title' => 'Email',
                'subTitle' => 'Components / Email',
            ]);
    }

    #[Route('/terms-condition', name: 'termsCondition')]
    public function termsCondition(): Response
    {
            return $this->render('termsCondition.html.twig', [
                'title' => 'Terms & Conditions',
                'subTitle' => 'Terms & Conditions',
                'multi_script' => "<script src='/assets/js/editor.highlighted.min.js'></script>
                                   <script src='/assets/js/editor.quill.js'></script>
                                   <script src='/assets/js/editor.katex.min.js'></script>",

            ]);
    }

    #[Route('/view-details', name: 'viewDetails')]
    public function viewDetails(): Response
    {
            return $this->render('viewDetails.html.twig', [
                'title' => 'Email',
                'subTitle' => 'Components / Email',
            ]);
    }

    #[Route('/widgets', name: 'widgets')]
    public function widgets(): Response
    {
            return $this->render('widgets.html.twig', [
                'title' => 'Widgets',
                'subTitle' => 'Widgets',
                'script' => "<script src='/assets/js/widgets.js'></script>",
            ]);
    }

}
