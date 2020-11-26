<?php

namespace App\Controller;

use App\Entity\Gpu;
use App\Manager\GpuManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;

class GpuController extends AbstractFOSRestController
{
    private $gpuManager;
    private $em;

    public function __construct(GpuManager $gpuManager, EntityManagerInterface $em)
    {
        $this->gpuManager = $gpuManager;
        $this->em = $em;
    }

    //List of all gpu

    /**
     * @Rest\Get("/api/gpu")
     * @Rest\View(serializerGroups={"gpu"})
     * @SWG\Get(
     *      tags={"GPU"},
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
    public function getApiAllGpu()
    {
        $allGpu = $this->gpuManager->findAll();
        return $this->view($allGpu, 200);
    }

    /**
     * @Rest\Get("/api/gpu/count")
     * @Rest\View(serializerGroups={"gpu"})
     * @SWG\Get(
     *      tags={"GPU"},
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
    public function getApiGpuCount()
    {
        $allGpu = $this->gpuManager->getCount();
        return $this->view($allGpu, 200);
    }

    //One Gpu

    /**
     * @Rest\Get("/api/gpu/{id}")
     * @Rest\View(serializerGroups={"gpu"})
     * @SWG\Get(
     *     tags={"GPU"},
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
     */
    public function getApiUserProfile(Gpu $gpu)
    {
        return $this->view($gpu, 200);
    }

    /**
     * @Rest\Post("/api/gpu/add")
     * @ParamConverter("gpu", converter="fos_rest.request_body")
     * @Rest\View(serializerGroups={"gpu"})
     * @Security(name="api_key")
     * @SWG\Post(
     *      tags={"GPU"},
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
     * @param Gpu $gpu
     * @param GpuManager $gpuManager
     * @param ConstraintViolationListInterface $validationErrors
     * @return \FOS\RestBundle\View\View
     */
    public function postApiAddGpu(Gpu $gpu, GpuManager $gpuManager, ConstraintViolationListInterface $validationErrors)
    {
        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $gpuManager->validateMyPostAssert($validationErrors);

        $this->em->persist($gpu);
        $this->em->flush();
        return $this->view($gpu, 201);
    }

    /**
     * @Rest\Delete("/api/gpu/remove/{id}")
     * @Rest\View(serializerGroups={"gpu"})
     * @Security(name="api_key")
     * @SWG\Delete(
     *      tags={"GPU"},
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
     * @param Gpu $gpu
     * @return \FOS\RestBundle\View\View
     */
    public function deleteApiGpu(Gpu $gpu)
    {
        $this->em->remove($gpu);
        $this->em->flush();
        return $this->view($gpu, 204);
    }
}
