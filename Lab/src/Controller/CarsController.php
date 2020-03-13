<?php

namespace App\Controller;

use App\Entity\Cars;
use Psr\Log\LoggerInterface;
use App\Repository\CarsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/api")
 */
class CarsController extends AbstractController
{
    private $logger;
    private $carsRepository;
    private $validator;

    public function __construct(LoggerInterface $logger, CarsRepository $carsRepository, ValidatorInterface $validator)
    {
        $this->logger = $logger;
        $this->carsRepository = $carsRepository;
        $this->validator = $validator;
    }

    /**
     * @Route("/cars", name="all_cars", methods={"GET"})
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     */
    public function getAllCars(Request $request, LoggerInterface $logger) : Response
    {
        $cars = $this->carsRepository->findAllCars();

        if (!empty($cars)) {
            $this->logger->info('Show all cars');
            return $this->json([
                'cars' => $cars,
                'code' => Response::HTTP_OK,
            ]);
        } else {
            $this->logger->error('They are no cars');
            return $this->json([
                'message' => "The have not cars",
                'code' => Response::HTTP_NOT_FOUND,
            ]);
        }

    }

    /**
     * @Route("/cars/{id}", name="show_cars", methods={"GET"}))
     */
    public function getOneCars(Cars $cars, $id)
    {
        $cars = $this->carsRepository->findCarsById($id);

        if (!empty($cars)) {
            $this->logger->info("Show cars n°".$id);
            return $this->json([
                'cars' => $cars,
                'code' => Response::HTTP_OK,
            ]);
        } else {
            $this->logger->error("the cars n°".$id." does not exist");
            return $this->json([
                'message' => "the cars ".$id." does not exist",
                'code' => Response::HTTP_NOT_FOUND,
            ]);
        }
    }

    /**
     * @Route("/create/cars", name="create_cars", methods={"POST"}))
     */
    public function postCars(Cars $cars, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $form = $this->createForm('App\Form\CarsType', $cars);
        $form->submit($data);
        $em = $this->getDoctrine()->getManager();

        $errors = $this->validator->validate($cars);
        
        if ($errors){
            for ($i = 0; $errors->count() > $i; $i++) {
                $errorsMessages[] = $errors->get($i)->getMessage();
            }
            if (isset($errorsMessages)){
                $this->logger->error($errorsMessages);
                return $this->json([
                    'errors' => $errorsMessages,
                    'code' => Response::HTTP_BAD_REQUEST,
                ]);
            }
        }

        $cars->setDateCirculation(\DateTime::createFromFormat('d-m-Y', $data['date_circulation']));
        
        $em->persist($cars);
        $em->flush();
        $this->logger->info("The cars have been created");

        return $this->json([
            'content' => $data,
            'code' => Response::HTTP_CREATED,
        ]);
    }

    /**
     * @Route("/edit/cars/{id}", name="edit_cars", methods={"PUT"}))
     */
    public function updateCars($id, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $request = new Request();
        $cars = $this->getDoctrine()->getRepository('App:Cars')->find($id);

        if (empty($cars)){
            $this->logger->error('This cars does not exist');
            return $this->json([
                'message' => 'This cars does not exist',
                'code' => Response::HTTP_BAD_REQUEST,
            ]);
        }

        $cars->setDateCirculation(\DateTime::createFromFormat('d-m-Y', $data['date_circulation']));

        $form = $this->createForm('App\Form\CarsType', $cars);
        $form->submit($data);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->json([
            'content' => $data,
            'code' => Response::HTTP_OK,
        ]);
    }

    /**
     * @Route("/delete/cars/{id}", name="delete_cars", methods={"DELETE"})
     */
    public function deleteCars($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $this->getDoctrine()->getRepository('App:Cars')->find($id);

        if (empty($cars)){
            $this->logger->error('This cars does not exist');
            return $this->json([
                'message' => 'This cars does not exist',
                'code' => Response::HTTP_BAD_REQUEST,
            ]);
        }

        $em->remove($cars);
        $em->flush();
        $this->logger->info("The cars have been deleted");
        
        return $this->json([
            'message' => 'The cars n°'.$id.' have been deleted',
            'code' => Response::HTTP_NO_CONTENT,
        ]);
    }
}
