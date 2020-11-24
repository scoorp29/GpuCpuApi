<?php


namespace App\Command;


use App\Service\Scraping;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ScrapingCommand extends Command
{
    protected static $defaultName = 'app:scraping';
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input,$output);
        $scraping = $this->container->get(Scraping::class);
        $scraping->scrapAMD();
        $scraping->scrapIntel();

        $io->success('Fin de la commande');
    }
}
