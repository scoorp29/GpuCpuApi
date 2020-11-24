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
        $now = new \DateTime();
        $yearNow = (int)$now->format('Y');
        $start = 2018;
        $newClient = new Client();
        while ($start <= $yearNow) {
            $crawler = $newClient->request('GET', "https://www.techpowerup.com/cpu-specs/?mfgr=AMD&released={$start}&sort=released");

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
            $start++;
        }
        $this->em->flush();
        return true;
    }

    public function scrapIntel()
    {
        $now = new \DateTime();
        $yearNow = (int)$now->format('Y');
        $start = 2018;
        $newClient = new Client();
        while ($start <= $yearNow) {

            $crawler = $newClient->request('GET', "https://www.techpowerup.com/cpu-specs/?mfgr=Intel&released={$start}&sort=released");
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
            $start++;
        }
        $this->em->flush();
        return true;
    }

    public function scrapCguAMD()
        {
            $now = new \DateTime();
            $yearNow = (int)$now->format('Y');
            $start = 2018;
            $newClient = new Client();
            while ($start <= $yearNow) {
                $crawler = $newClient->request('GET', "https://www.techpowerup.com/gpu-specs/?mfgr=AMD&released={$start}&sort=released");
    
                $crawler->filter('tr')->each(function ($node) {
                    $string = ltrim($node->filter('tr')->text());
                    $array = explode("\n", $string);
                    if (count($array) >= 10) {
                        if ($array[0] != 'Name') {
                            $cg = $this->em->getRepository(Cpu::class)->findBy(['product_name' => $array[0]]);
                            if (!$cg) {
                                $newcg = new Cpu();
                                $newcg->setProductName($array[0]);
                                $newcg->setGPUChip($array[2]);
                                $newcg->setCompany('AMD');
                                $newcg->setReleased($array[3]);
                                $newcg->setBus($array[4]);
                                $newcg->setMemory($array[5]);
                                $newcg->setGPUclock($array[6]);
                                $newcg->setMemoryclock($array[7]);
                                $newcg->setShaders($array[8]);
                                $this->em->persist($newcg);
                            }
                        }
                    }
                });
                $start++;
            }
            $this->em->flush();
            return true;
        }
    
        public function scrapCguIntel()
        {
            $now = new \DateTime();
            $yearNow = (int)$now->format('Y');
            $start = 2018;
            $newClient = new Client();
            while ($start <= $yearNow) {
    
                $crawler = $newClient->request('GET', "https://www.techpowerup.com/cpu-specs/?mfgr=Intel&released={$start}&sort=released");
                $crawler->filter('tr')->each(function ($node) {
                    $string = ltrim($node->filter('tr')->text());
                    $array = explode("\n", $string);
                    if (count($array) >= 10) {
                        if ($array[0] != 'Name') {
                            $cg = $this->em->getRepository(Cpu::class)->findBy(['product_name' => $array[0]]);
                            if (!$cg) {
                                $newcg = new Cpu();
                                $newcg->setProductName($array[0]);
                                $newcg->setGPUChip($array[2]);
                                $newcg->setCompany('Intel');
                                $newcg->setReleased($array[3]);
                                $newcg->setBus($array[4]);
                                $newcg->setMemory($array[5]);
                                $newcg->setGPUclock($array[6]);
                                $newcg->setMemoryclock($array[7]);
                                $newcg->setShaders($array[8]);
                                $this->em->persist($newcg);
                            }
                        }
                    }
                });
                $start++;
            }
            $this->em->flush();
            return true;
        }
    
        public function scrapCguIntel()
        {
            $now = new \DateTime();
            $yearNow = (int)$now->format('Y');
            $start = 2018;
            $newClient = new Client();
            while ($start <= $yearNow) {
    
                $crawler = $newClient->request('GET', "https://www.techpowerup.com/cpu-specs/?mfgr=NVIDIA&released={$start}&sort=released");
                $crawler->filter('tr')->each(function ($node) {
                    $string = ltrim($node->filter('tr')->text());
                    $array = explode("\n", $string);
                    if (count($array) >= 10) {
                        if ($array[0] != 'Name') {
                            $cg = $this->em->getRepository(Cpu::class)->findBy(['product_name' => $array[0]]);
                            if (!$cg) {
                                $newcg = new Cpu();
                                $newcg->setProductName($array[0]);
                                $newcg->setGPUChip($array[2]);
                                $newcg->setCompany('NVIDIA');
                                $newcg->setReleased($array[3]);
                                $newcg->setBus($array[4]);
                                $newcg->setMemory($array[5]);
                                $newcg->setGPUclock($array[6]);
                                $newcg->setMemoryclock($array[7]);
                                $newcg->setShaders($array[8]);
                                $this->em->persist($newcg);
                            }
                        }
                    }
                });
                $start++;
            }
            $this->em->flush();
            return true;
        }
    
    }

}
