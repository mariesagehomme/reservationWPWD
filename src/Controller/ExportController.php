<?php

namespace App\Controller;

use App\Entity\Show;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends AbstractController
{
    /**
     * @Route("/export", name="export_index")
     */
    public function index()
    {
        $title = 'Export';
        return $this->render('export/index.html.twig', [
            'title' => $title,
        ]);    
    }
    
     /**
     * @Route("/export/export", name="export_export")
     */
    public function generateCsvAction() {
        
        //https://www.jdecool.fr/blog/2015/10/09/exporter-un-fichier-csv-avec-symfony2.html
        $repository = $this->getDoctrine()->getRepository(Show::class);

        $response = new StreamedResponse();
        $response->setCallback(function() use ($repository) {
            $handle = fopen('php://output', 'w+');

            fputcsv($handle, ['Title', 'Description', 'Location', 'Price']);

            $results = $repository->findAll();
            foreach ($results as $exportShows) {
                fputcsv(
                    $handle,
                    [$exportShows->getTitle(), $exportShows->getDescription(), $exportShows->getLocation(), $exportShows->getPrice() ]
                 );
            }

            fclose($handle);
        });

        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition','attachment; filename="export-shows.csv"');

    return $response;
    }
}
