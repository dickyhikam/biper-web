<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InvoiceController extends AbstractController
{

    #[Route('invoice/invoice-add', name: 'invoiceAdd')]
    public function invoiceAdd(): Response
    {
            return $this->render('invoice/invoiceAdd.html.twig', [
                'title' => 'Invoice List',
                'subTitle' => 'Invoice List',
                'script' => "<script src='/assets/js/invoice.js'></script>",
            ]);
    }

    #[Route('invoice/invoice-edit', name: 'invoiceEdit')]
    public function invoiceEdit(): Response
    {
            return $this->render('invoice/invoiceEdit.html.twig', [
                'title' => 'invoice Edit',
                'subTitle' => 'invoice Edit',
                'script' => "<script src='/assets/js/invoice.js'></script>",
            ]);
    }

    #[Route('invoice/invoice-list', name: 'invoiceList')]
    public function invoiceList(): Response

    {
            return $this->render('invoice/invoiceList.html.twig', [
                'title' => 'invoice List',
                'subTitle' => 'invoice List',
                'script' => "<script src='/assets/js/invoice.js'></script>",
            ]);
    }

    #[Route('invoice/invoice-preview', name: 'invoicePreview')]
    public function invoicePreview(): Response

    {
            return $this->render('invoice/invoicePreview.html.twig', [
                'title' => 'invoice Preview',
                'subTitle' => 'invoice Preview',
                'script' => "<script src='/assets/js/invoice.js'></script>",
            ]);
    }
}
