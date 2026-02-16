<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TableController extends AbstractController
{
    #[Route('table/table-basic',name:'tableBasic')]
    public function tableBasic():Response
    {
        return $this->render('table/tableBasic.html.twig',[
            'title' => 'Basic Table',
            'subTitle' => 'Basic Table',
        ]);
    }

    #[Route('table/table-data',name:'tableData')]
    public function tableData():Response
    {
        return $this->render('table/tableData.html.twig',[
            'title' => 'Data Table',
            'subTitle' => 'Data Table',
            'script' => "<script src='/assets/js/data-table.js'></script>",
        ]);
    }
}
