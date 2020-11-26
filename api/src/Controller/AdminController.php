<?php

namespace App\Controller;

use App\Manager\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class AdminController extends AbstractFOSRestController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Rest\Get("/api/admin/profile")
     * @Rest\View(serializerGroups={"user", "subscription"})
     * @Security(name="api_key")
     * @SWG\Get(
     *      tags={"Admin"},
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
    public function getApiAdminProfile()
    {
        $user = $this->getUser();
        return $this->view($user, 200);
    }

    /**
     * @Rest\Patch("/api/admin/profile")
     * @Rest\View(serializerGroups={"user", "subscription"})
     * @Security(name="api_key")
     * @SWG\Patch(
     *      tags={"Admin"},
     *      @SWG\Response(
     *             response=200,
     *             description="Success",
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
    public function patchApiAdminProfile(Request $request, UserManager $userManager, ValidatorInterface $validator)
    {
        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return false if not
        $user = $this->getUser();

        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $email = $request->get('email');

        if (null !== $firstname) {
            $user->setFirstname($firstname);
        }

        if (null !== $lastname) {
            $user->setLastname($lastname);
        }

        if (null !== $email) {
            $user->setEmail($email);
        }

        //We test if all the conditions are fulfilled (Assert in Entity / User)
        //Return -> Throw a 400 Bad Request with all errors messages
        $userManager->validateMyPatchAssert($user, $validator);

        $this->em->persist($user);
        $this->em->flush();
        return $this->view($user, 200);
    }
}