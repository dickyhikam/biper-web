<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AiapplicationController extends AbstractController
{
    #[Route('aiapplication/code-generator',name:'codeGenerator')]
    public function codeGenerator():Response
    {
        return $this->render('aiapplication/codeGenerator.html.twig',[
            'title' => 'Code Generator',
            'subTitle' => 'Code Generator',
        ]);
    }

    #[Route('aiapplication/code-generator-new',name:'codeGeneratorNew')]
    public function codeGeneratorNew():Response
    {
        return $this->render('aiapplication/codeGeneratorNew.html.twig',[
            'title' => 'Code Generator',
            'subTitle' => 'Code Generator',
        ]);
    }

    #[Route('aiapplication/image-generator',name:'imageGenerator')]
    public function imageGenerator():Response
    {
        return $this->render('aiapplication/imageGenerator.html.twig',[
            'title' => 'Image Generator',
            'subTitle' => 'Image Generator',
        ]);
    }

    #[Route('aiapplication/text-generator',name:'textGenerator')]
    public function textGenerator():Response
    {
        return $this->render('aiapplication/textGenerator.html.twig',[
            'title' => 'Text Generator',
            'subTitle' => 'Text Generator',
        ]);
    }

    #[Route('aiapplication/text-generator-new',name:'textGeneratorNew')]
    public function textGeneratorNew():Response
    {
        return $this->render('aiapplication/textGeneratorNew.html.twig',[
            'title' => 'Text Generator',
            'subTitle' => 'Text Generator',
        ]);
    }

    #[Route('aiapplication/video-generator',name:'videoGenerator')]
    public function videoGenerator():Response
    {
        return $this->render('aiapplication/videoGenerator.html.twig',[
            'title' => 'Video Generator',
            'subTitle' => 'Video Generator',
        ]);
    }

    #[Route('aiapplication/voice-generator',name:'voiceGenerator')]
    public function voiceGenerator():Response
    {
        return $this->render('aiapplication/voiceGenerator.html.twig',[
            'title' => 'voice Generator',
            'subTitle' => 'voice Generator',
        ]);
    }
}
