<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ComponentspageController extends AbstractController
{
        #[Route('componentspage/alert',name:'alert')]
        public function alert():Response
        {
                return $this->render('componentspage/alert.html.twig',[
                        'title' => 'Alert',
                        'subTitle' => 'Components / Alert',
                ]);
        }

        #[Route('componentspage/avatar',name:'avatar')]
        public function avatar():Response
        {
                return $this->render('componentspage/avatar.html.twig',[   
                        'title' => 'Avatar',
                        'subTitle' => 'Components / Avatar',
                ]);
        }

        #[Route('componentspage/badges',name:'badges')]
        public function badges():Response
        {
                return $this->render('componentspage/badges.html.twig',[
                        'title' => 'Badges',
                        'subTitle' => 'Components / Badges',
                ]);
        }

        #[Route('componentspage/button',name:'button')]
        public function button():Response
        {
                return $this->render('componentspage/button.html.twig',[
                        'title' => 'Button',
                        'subTitle' => 'Components / Button',
                ]);
        }

        #[Route('componentspage/calendar',name:'calendar')]
        public function calendar():Response
        {
                return $this->render('componentspage/calendar.html.twig',[
                        'title' => 'Calendar',
                        'subTitle' => 'Components / Calendar',
                        'multi_script' => "<script src='/assets/js/flatpickr.js'></script>
                                           <script src='/assets/js/full-calendar.js'></script>",
                ]);
        }

        #[Route('componentspage/card',name:'card')]
        public function card():Response
        {
                return $this->render('componentspage/card.html.twig',[
                        'title' => 'Card',
                        'subTitle' => 'Components / Card',
                        'multi_script' => "<script src='/assets/js/flatpickr.js'></script>
                                           <script src='/assets/js/full-calendar.js'></script>",
                ]);
        }

        #[Route('componentspage/carousel',name:'carousel')]
        public function carousel():Response
        {
                return $this->render('componentspage/carousel.html.twig',[
                'title' => 'Carousel',
                'subTitle' => 'Components / Carousel',
                'script' => "<script src='/assets/js/defaultCarousel.js'></script>",
                ]);
        }

        #[Route('componentspage/colors',name:'colors')]
        public function colors():Response
        {
                return $this->render('componentspage/colors.html.twig',[
                'title' => 'Colors',
                'subTitle' => 'Components / Colors',
                ]);
        }

        #[Route('componentspage/dropdown',name:'dropdown')]
        public function dropdown():Response
        {
                return $this->render('componentspage/dropdown.html.twig',[
                'title' => 'Dropdown',
                'subTitle' => 'Components / Dropdown',
                ]);
        }

        #[Route('componentspage/imageUpload',name:'imageUpload')]
        public function imageUpload():Response
        {
                return $this->render('componentspage/imageUpload.html.twig',[
                'title' => 'Image Upload',
                'subTitle' => 'Components / Image Upload',
                ]);
        }

        #[Route('componentspage/lists',name:'lists')]
        public function lists():Response
        {
                return $this->render('componentspage/lists.html.twig',[
                'title' => 'Lists',
                'subTitle' => 'Components / Lists',
                ]);
        }

        #[Route('componentspage/pagination',name:'pagination')]
        public function pagination():Response
        {
                return $this->render('componentspage/pagination.html.twig',[
                'title' => 'Pagination',
                'subTitle' => 'Components / Pagination',
                ]);  
        }

        #[Route('componentspage/progress',name:'progress')]
        public function progress():Response
        {
                return $this->render('componentspage/progress.html.twig',[
                'title' => 'Progress Bar',
                'subTitle' => 'Components / Progress Bar',
                ]);
        }

        #[Route('componentspage/radio',name:'radio')]
        public function radio():Response
        {
                return $this->render('componentspage/radio.html.twig',[
                'title' => 'Radio',
                'subTitle' => 'Components / Radio',
                ]);
        }

        #[Route('componentspage/star-rating',name:'starRating')]
        public function starRating():Response
        {
                return $this->render('componentspage/starRating.html.twig',[
                'title' => 'Star Rating',
                'subTitle' => 'Components / Star Rating',
                ]);
        }

        #[Route('componentspage/switch',name:'switch')]
        public function switch():Response
        {
                return $this->render('componentspage/switch.html.twig',[
                'title' => 'Switch',
                'subTitle' => 'Components / Switch',
                ]);
        }

        #[Route('componentspage/tabs',name:'tabs')]
        public function tabs():Response
        {
                return $this->render('componentspage/tabs.html.twig',[
                'title' => 'Tab & Accordion',
                'subTitle' => 'Components / Tab & Accordion',
                ]);
        }

        #[Route('componentspage/tags',name:'tags')]
        public function tags():Response
        {
                return $this->render('componentspage/tags.html.twig',[
                'title' => 'Tags',
                'subTitle' => 'Components / Tags',
                ]);
        }

        #[Route('componentspage/tooltip',name:'tooltip')]
        public function tooltip():Response
        {
                return $this->render('componentspage/tooltip.html.twig',[
                'title' => 'Tooltip & Popover',
                'subTitle' => 'Components / Tooltip & Popover',
                'script' => "<script src='/assets/js/defaultCarousel.js'></script>",
                ]);
        }

        #[Route('componentspage/typography',name:'typography')]
        public function typography():Response
        {
                return $this->render('componentspage/typography.html.twig',[
                'title' => 'Typography',
                'subTitle' => 'Components / Typography',
                ]);
        }

        #[Route('componentspage/videos',name:'videos')]
        public function videos():Response
        {
                return $this->render('componentspage/videos.html.twig',[
                'title' => 'Videos',
                'subTitle' => 'Components / Videos',
                ]);
        }

        #[Route('cryptocurrency/wallet',name:'wallet')]
        public function wallet():Response
        {
                return $this->render('cryptocurrency/wallet.html.twig',[
                'title' => 'Wallet',
                'subTitle' => 'Wallet',
                ]);
        }

}
