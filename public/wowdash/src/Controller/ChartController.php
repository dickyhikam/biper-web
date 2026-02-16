<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ChartController extends AbstractController
{
    #[Route('chart/columnChart',name:'columnChart')]
    public function columnChart():Response
    {
        return $this->render('chart/column-chart.html.twig',[
            'title' => 'Column Chart',
            'subTitle' => 'Components / Column Chart',
            'script' => "<script src='/assets/js/columnChartPageChart.js'></script>",
        ]);
    }

    #[Route('chart/line-chart',name:'lineChart')]
    public function lineChart():Response
    {
        return $this->render('chart/lineChart.html.twig',[
            'title' => 'Line Chart',
            'subTitle' => 'Components / Line Chart',
            'script' => "<script src='/assets/js/lineChartPageChart.js'></script>",
        ]);
    }

    #[Route('chart/pie-chart',name:'pieChart')]
    public function PieChart():Response
    {
        return $this->render('chart/pieChart.html.twig',[
            'title' => 'Pie Chart',
            'subTitle' => 'Components / Pie Chart',
            'script' => "<script src='/assets/js/pieChartPageChart.js'></script>",
        ]);
    }
}
