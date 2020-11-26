<?php

namespace App\Controller;

use App\Entity\Cpu;
use App\Manager\CpuManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CpuController extends AbstractFOSRestController
{
    private $cpuManager;
    private $em;

    public function __construct(CpuManager $cpuManager, EntityManagerInterface $em)
    {
        $this->cpuManager = $cpuManager;
        $this->em = $em;
    }

    //List of all cpu

    /**
     * @Rest\Get("/api/cpu/count")
     * @Rest\View(serializerGroups={"cpu"})
     * @SWG\Get(
     *      tags={"CPU"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
     *         ),
     *     @SWG\Response(
     *             response=204,
     *             description="No Content",
     *         ),
     *      @SWG\Response(
     *             response=400,
     *             description="Bad Request",
     *         ),
     *      @SWG\Response(
     *             response=403,
     *             description="Forbiden",
     *         ),
     *      @SWG\Response(
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     */
    public function getApiCpuCount()
    {
        $allCpu = $this->cpuManager->getCount();
        return $this->view($allCpu, 200);
    }

    /**
     * @Rest\Get("/api/cpu")
     * @Rest\View(serializerGroups={"cpu"})
     * @SWG\Get(
     *      tags={"CPU"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
     *         ),
     *     @SWG\Response(
     *             response=204,
     *             description="No Content",
     *         ),
     *      @SWG\Response(
     *             response=400,
     *             description="Bad Request",
     *         ),
     *      @SWG\Response(
     *             response=403,
     *             description="Forbiden",
     *         ),
     *      @SWG\Response(
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     */
    public function getApiAllCpu()
    {
        $allCpu = $this->cpuManager->findAll();
        return $this->view($allCpu, 200);
    }

    //One cpu

    /**
     * @Rest\Get("/api/cpu/{id}")
     * @Rest\View(serializerGroups={"cpu"})
     * @SWG\Get(
     *     tags={"CPU"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
     *         ),
     *     @SWG\Response(
     *             response=204,
     *             description="No Content",
     *         ),
     *      @SWG\Response(
     *             response=400,
     *             description="Bad Request",
     *         ),
     *      @SWG\Response(
     *             response=403,
     *             description="Forbiden",
     *         ),
     *      @SWG\Response(
     *             response=404,
     *             description="Not Found",
     *         ),
     *     )
     * @param Cpu $cpu
     * @return \FOS\RestBundle\View\View
     */
    public function getApiUserProfile(Cpu $cpu)
    {
        return $this->view($cpu, 200);
    }

    /**
     * @Rest\Post("/api/cpu/add")
     * @ParamConverter("cpu", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"cpu"})
     * @Security(name="api_key")
     * @SWG\Post(
     *      tags={"CPU"},
     *      @SWG\Response(
     *             response=201,
     *             description="Created",
     *         ),
     *      @SWG\Response(
     *             response=400,
     *             description="Bad Request",
     *         ),
     *      @SWG\Response(
     *             response=403,
     *             description="Forbiden",
     *         ),
     *      @SWG\Response(
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param Cpu $cpu
     * @param CpuManager $cpuManager
     * @param ConstraintViolationListInterface $validationErrors
     * @return \FOS\RestBundle\View\View
     */
    public function postApiAddGpu(Cpu $cpu, CpuManager $cpuManager, ConstraintViolationListInterface $validationErrors)
    {
        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $cpuManager->validateMyPostAssert($validationErrors);

        $this->em->persist($cpu);
        $this->em->flush();
        return $this->view($cpu, 201);
    }

    /**
     * @Rest\Delete("/api/cpu/remove/{id}")
     * @Rest\View(serializerGroups={"cpu"})
     * @Security(name="api_key")
     * @SWG\Delete(
     *      tags={"CPU"},
     *     @SWG\Response(
     *             response=204,
     *             description="No Content",
     *         ),
     *      @SWG\Response(
     *             response=400,
     *             description="Bad Request",
     *         ),
     *      @SWG\Response(
     *             response=403,
     *             description="Forbiden",
     *         ),
     *      @SWG\Response(
     *             response=404,
     *             description="Not Found",
     *         ),
     *)
     * @param Cpu $cpu
     * @return \FOS\RestBundle\View\View
     */
    public function deleteApiGpu(Cpu $cpu)
    {
        $this->em->remove($cpu);
        $this->em->flush();
        return $this->view($cpu, 204);
    }
}
