<?php


namespace App\Manager;

use App\Entity\Cpu;
use App\Repository\CpuRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CpuManager
{
    private $cpuRepository;

    public function __construct(CpuRepository $cpuRepository)
    {
        $this->cpuRepository = $cpuRepository;
    }

    public function findAll()
    {
        return $this->cpuRepository->findAll();
    }

    public function getCount()
    {
        return $this->cpuRepository->getCpuByCompany();
    }

    //We test if all the conditions are fulfilled (Assert in Entity / User)
    public function validateMyPostAssert(ConstraintViolationListInterface $validationErrors)
    {
        $errors = array();
        if ($validationErrors->count() > 0) {
            /** @var ConstraintViolation $constraintViolation */
            foreach ($validationErrors as $constraintViolation) {
                // Returns the violation message. (Ex. This value should not be blank.)
                $message = $constraintViolation->getMessage();
                // Returns the property path from the root element to the violation. (Ex. lastname)
                $propertyPath = $constraintViolation->getPropertyPath();
                $errors[] = ['message' => $message, 'propertyPath' => $propertyPath];
            }
        }

        if (!empty($errors)) {
            // Throw a 400 Bad Request with all errors messages
            throw new BadRequestHttpException(\json_encode($errors));
        }
    }

    //We test if all the conditions are fulfilled (Assert in Entity / User)
    public function validateMyPatchAssert(Cpu $cpu, ValidatorInterface $validator)
    {
        $validationErrors = $validator->validate($cpu);
        $errors = array();
        if ($validationErrors->count() > 0) {
            /** @var ConstraintViolation $constraintViolation */
            foreach ($validationErrors as $constraintViolation) {
                // Returns the violation message. (Ex. This value should not be blank.)
                $message = $constraintViolation->getMessage();
                // Returns the property path from the root element to the violation. (Ex. lastname)
                $propertyPath = $constraintViolation->getPropertyPath();
                $errors[] = ['message' => $message, 'propertyPath' => $propertyPath];
            }
        }

        if (!empty($errors)) {
            // Throw a 400 Bad Request with all errors messages
            throw new BadRequestHttpException(\json_encode($errors));
        }
    }
}
