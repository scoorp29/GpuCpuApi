<?php


namespace App\Service;

use App\Entity\Cpu;
use App\Entity\Gpu;
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
        // On récupère la date d'aujourd'hui
        $now = new \DateTime();
        // On garde l'année
        $yearNow = (int)$now->format('Y');
        $start = 2018;
        // Création de notre entité pour scraper
        $newClient = new Client();
        // Parcours de chaque page par année
        while ($start <= $yearNow) {
            $crawler = $newClient->request('GET', "https://www.techpowerup.com/cpu-specs/?mfgr=AMD&released={$start}&sort=released");
            // On récupère les balises tr de la page puis on les parcours
            $crawler->filter('tr')->each(function ($node) {
                // On stock dans notre variable la ligne du tableau concernée
                $string = ltrim($node->filter('tr')->text());
                // On divise notre string en array
                $array = explode("\n", $string);
                if (count($array) >= 10) {
                    if ($array[0] != 'Name') {
                        // On cherche dans notre bdd si le produit existe déjà
                        $proc = $this->em->getRepository(Cpu::class)->findBy(['product_name' => $array[0]]);
                        if (!$proc) {
                            // Création d'un processeur
                            $newProc = new Cpu();
                            $newProc->setProductName(ltrim($array[0]));
                            $newProc->setCodeName(ltrim($array[2]));
                            $newProc->setCompany('AMD');
                            $newProc->setCores(ltrim($array[3]));
                            $newProc->setClock(ltrim($array[4]));
                            $newProc->setSocket(ltrim($array[5]));
                            $newProc->setProcess(ltrim($array[6]));
                            $newProc->setL3Cache(ltrim($array[7]));
                            $newProc->setTdp(ltrim($array[8]));
                            $newProc->setReleased(ltrim($array[9]));
                            $this->em->persist($newProc);
                        }
                    }
                }
            });
            // Incrémentation de la date
            $start++;
        }
        $this->em->flush();
        return true;
    }

    public function scrapIntel()
    {
        // On récupère la date d'aujourd'hui
        $now = new \DateTime();
        // On garde l'année
        $yearNow = (int)$now->format('Y');
        $start = 2018;
        // Création de notre entité pour scraper
        $newClient = new Client();
        // Parcours de chaque page par année
        while ($start <= $yearNow) {
            $crawler = $newClient->request('GET', "https://www.techpowerup.com/cpu-specs/?mfgr=Intel&released={$start}&sort=released");
            // On récupère les balises tr de la page puis on les parcours
            $crawler->filter('tr')->each(function ($node) {
                // On stock dans notre variable la ligne du tableau concernée
                $string = ltrim($node->filter('tr')->text());
                // On divise notre string en array
                $array = explode("\n", $string);
                if (count($array) >= 10) {
                    if ($array[0] != 'Name') {
                        // On cherche dans notre bdd si le produit existe déjà
                        $proc = $this->em->getRepository(Cpu::class)->findBy(['product_name' => $array[0]]);
                        if (!$proc) {
                            // Création d'un processeur
                            $newProc = new Cpu();
                            $newProc->setProductName(ltrim($array[0]));
                            $newProc->setCodeName(ltrim($array[2]));
                            $newProc->setCompany('Intel');
                            $newProc->setCores(ltrim($array[3]));
                            $newProc->setClock(ltrim($array[4]));
                            $newProc->setSocket(ltrim($array[5]));
                            $newProc->setProcess(ltrim($array[6]));
                            $newProc->setL3Cache(ltrim($array[7]));
                            $newProc->setTdp(ltrim($array[8]));
                            $newProc->setReleased(ltrim($array[9]));
                            $this->em->persist($newProc);
                        }
                    }
                }
            });
            // Incrémentation de la date
            $start++;
        }
        $this->em->flush();
        return true;
    }

    public function scrapGpuAMD()
    {
        // On récupère la date d'aujourd'hui
        $now = new \DateTime();
        // On garde l'année
        $yearNow = (int)$now->format('Y');
        $start = 2018;
        // Création de notre entité pour scraper
        $newClient = new Client();
        // Parcours de chaque page par année
        while ($start <= $yearNow) {
            $crawler = $newClient->request('GET', "https://www.techpowerup.com/gpu-specs/?mfgr=AMD&released={$start}&sort=released");
            // On récupère les balises tr de la page puis on les parcours
            $crawler->filter('tr')->each(function ($node) {
                // On stock dans notre variable la ligne du tableau concernée
                $string = ltrim($node->filter('tr')->text());
                // On divise notre string en array
                $array = explode("\n", $string);
                if (count($array) >= 10) {
                    if ($array[0] != 'Name') {
                        // On cherche dans notre bdd si le produit existe déjà
                        $cg = $this->em->getRepository(Gpu::class)->findBy(['product_name' => $array[0]]);
                        if (!$cg) {
                            // Création d'une carte graphique
                            $newcg = new Gpu();
                            $newcg->setProductName(ltrim($array[0]));
                            $newcg->setGPUChip(ltrim($array[4]));
                            $newcg->setCompany('AMD');
                            $newcg->setReleaseDate(ltrim($array[7]));
                            $newcg->setBus(ltrim($array[8]));
                            $newcg->setMemory(ltrim($array[9]));
                            $newcg->setGPUclock(ltrim($array[10]));
                            $newcg->setMemoryclock(ltrim($array[11]));
                            $this->em->persist($newcg);
                        }
                    }
                }
            });
            // Incrémentation de la date
            $start++;
        }
        $this->em->flush();
        return true;
    }

    public function scrapGpuIntel()
    {
        // On récupère la date d'aujourd'hui
        $now = new \DateTime();
        // On garde l'année
        $yearNow = (int)$now->format('Y');
        $start = 2018;
        // Création de notre entité pour scraper
        $newClient = new Client();
        // Parcours de chaque page par année
        while ($start <= $yearNow) {
            $crawler = $newClient->request('GET', "https://www.techpowerup.com/gpu-specs/?mfgr=Intel&released={$start}&sort=released");
            // On récupère les balises tr de la page puis on les parcours
            $crawler->filter('tr')->each(function ($node) {
                // On stock dans notre variable la ligne du tableau concernée
                $string = ltrim($node->filter('tr')->text());
                // On divise notre string en array
                $array = explode("\n", $string);
                if (count($array) >= 10) {
                    if ($array[0] != 'Name') {
                        // On cherche dans notre bdd si le produit existe déjà
                        $cg = $this->em->getRepository(Gpu::class)->findBy(['product_name' => $array[0]]);
                        if (!$cg) {
                            // Création d'une carte graphique
                            $newcg = new Gpu();
                            $newcg->setProductName(ltrim($array[0]));
                            $newcg->setGPUChip(ltrim($array[4]));
                            $newcg->setCompany('Intel');
                            $newcg->setReleaseDate(ltrim($array[7]));
                            $newcg->setBus(ltrim($array[8]));
                            $newcg->setMemory(ltrim($array[9]));
                            $newcg->setGPUclock(ltrim($array[10]));
                            $newcg->setMemoryclock(ltrim($array[11]));
                            $this->em->persist($newcg);
                        }
                    }
                }
            });
            // Incrémentation de la date
            $start++;
        }
        $this->em->flush();
        return true;
    }

    public function scrapGpuNvidia()
    {
        // On récupère la date d'aujourd'hui
        $now = new \DateTime();
        // On garde l'année
        $yearNow = (int)$now->format('Y');
        $start = 2018;
        // Création de notre entité pour scraper
        $newClient = new Client();
        // Parcours de chaque page par année
        while ($start <= $yearNow) {
            $crawler = $newClient->request('GET', "https://www.techpowerup.com/gpu-specs/?mfgr=NVIDIA&released={$start}&sort=released");
            // On récupère les balises tr de la page puis on les parcours
            $crawler->filter('tr')->each(function ($node) {
                // On stock dans notre variable la ligne du tableau concernée
                $string = ltrim($node->filter('tr')->text());
                // On divise notre string en array
                $array = explode("\n", $string);
                if (count($array) >= 10) {
                    if ($array[0] != 'Name') {
                        // On cherche dans notre bdd si le produit existe déjà
                        $cg = $this->em->getRepository(Gpu::class)->findBy(['product_name' => $array[0]]);
                        if (!$cg) {
                            // Création d'une carte graphique
                            $newcg = new Gpu();
                            $newcg->setProductName(ltrim($array[0]));
                            $newcg->setGPUChip(ltrim($array[4]));
                            $newcg->setCompany('NVIDIA');
                            $newcg->setReleaseDate(ltrim($array[7]));
                            $newcg->setBus(ltrim($array[8]));
                            $newcg->setMemory(ltrim($array[9]));
                            $newcg->setGPUclock(ltrim($array[10]));
                            $newcg->setMemoryclock(ltrim($array[11]));
                            $this->em->persist($newcg);
                        }
                    }
                }
            });
            // Incrémentation de la date
            $start++;
        }
        $this->em->flush();
        return true;
    }

}
