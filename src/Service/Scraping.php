<?php


namespace App\Service;

use App\Entity\Cpu;
use Doctrine\ORM\EntityManagerInterface;
use Goutte\Client;

class Scraping
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function scrapAMD()
    {
        $newClient = new Client();
        $crawler = $newClient->request('GET', 'https://www.techpowerup.com/cpu-specs/?mfgr=AMD&sort=released');

        $crawler->filter('tr')->each(function ($node) {
            $string = ltrim($node->filter('tr')->text());
            $array = explode("\n", $string);
            if (count($array) >= 10) {
                if ($array[0] != 'Name') {
                    $proc = $this->em->getRepository(Cpu::class)->findBy(['product_name' => $array[0]]);
                    if (!$proc) {
                        $newProc = new Cpu();
                        $newProc->setProductName($array[0]);
                        $newProc->setCodeName($array[2]);
                        $newProc->setCompany('AMD');
                        $newProc->setCores($array[3]);
                        $newProc->setClock($array[4]);
                        $newProc->setSocket($array[5]);
                        $newProc->setProcess($array[6]);
                        $newProc->setL3Cache($array[7]);
                        $newProc->setTdp($array[8]);
                        $newProc->setReleased($array[9]);
                        $this->em->persist($newProc);
                    }
                }
            }
        });
        $this->em->flush();
        return true;
    }

    public function scrapIntel()
    {
        $newClient = new Client();
        $crawler = $newClient->request('GET', 'https://www.techpowerup.com/cpu-specs/?mfgr=Intel&sort=released');

        $crawler->filter('tr')->each(function ($node) {
            $string = ltrim($node->filter('tr')->text());
            $array = explode("\n", $string);
            if (count($array) >= 10) {
                if ($array[0] != 'Name') {
                    $proc = $this->em->getRepository(Cpu::class)->findBy(['product_name' => $array[0]]);
                    if (!$proc) {
                        $newProc = new Cpu();
                        $newProc->setProductName($array[0]);
                        $newProc->setCodeName($array[2]);
                        $newProc->setCompany('Intel');
                        $newProc->setCores($array[3]);
                        $newProc->setClock($array[4]);
                        $newProc->setSocket($array[5]);
                        $newProc->setProcess($array[6]);
                        $newProc->setL3Cache($array[7]);
                        $newProc->setTdp($array[8]);
                        $newProc->setReleased($array[9]);
                        $this->em->persist($newProc);
                    }
                }
            }
        });
        $this->em->flush();
        return true;
    }

}
