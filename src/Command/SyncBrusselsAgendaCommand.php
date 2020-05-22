<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpClient\HttpClient;

use App\Entity\Show;
use Cocur\Slugify\Slugify;


//informations https://symfony.com/doc/current/components/http_client.html

class SyncBrusselsAgendaCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:sync-brussels-agenda';
    
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        
        parent::__construct();
    }
    
    protected function configure()
    {
       $this
        // the short description shown while running "php bin/console list"
        ->setDescription('consult an api for the project - reservation marie sagehomme.')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command to consult an API')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $headers = [ 
            'Authorization' => 'Bearer ' . 'ba1d7ddd-9678-3670-af49-a47bc95700a8', 
            'Accept' => 'application/json',
        ];
        
        $client = HttpClient::create(['headers' => $headers]);

        $response = $client->request('GET', 'https://api.brussels:443/api/agenda/0.0.1/events?page=1');

        $content = json_decode($response->getContent(), TRUE);
        $events = $content['response']['results']['event'];
        
        // it's like my fixtures (show) so I copied slug 
        $slugify = new Slugify();
        foreach($events as $event){
            $show = new Show();
            
            $show->setSlug($slugify->slugify($event['translations']['fr']['name']));
            $show->setTitle($event['translations']['fr']['name']);
            $show->setBookable(true);
            
            $this->manager->persist($show);
        }

        $this->manager->flush();
        
        return 0; //return 0; if i want to know if I have some errors
    }
    
}