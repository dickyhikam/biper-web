<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FormsController extends AbstractController
{
    #[Route('forms/form', name: 'form')]
    public function form(): Response
    {
            return $this->render('forms/form.html.twig', [
                'title' => 'Input From',
                'subTitle' => 'Input From',
            ]);
    }

    #[Route('forms/form-layout', name: 'formLayout')]
    public function formLayout(): Response
    {
            return $this->render('forms/formLayout.html.twig', [
                'title' => 'Input Layout',
                'subTitle' => 'Input Layout',
            ]);
    }

    #[Route('forms/form-validation', name: 'formValidation')]
    public function formValidation(): Response
    {
            return $this->render('forms/formValidation.html.twig', [
                'title' => 'Form Validation',
                'subTitle' => 'Form Validation',
            ]);
    }

    #[Route('forms/wizard', name: 'wizard')]
    public function fWizard(): Response
    {
            return $this->render('forms/wizard.html.twig', [
                'title' => 'wizard',
                'subTitle' => 'wizard',
            ]);
    }

}
