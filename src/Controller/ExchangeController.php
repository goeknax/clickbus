<?php

namespace App\Controller;

use App\Entity\ExchangeLog;
use App\Repository\ExchangeLogRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use DateTime;

class ExchangeController extends AbstractController
{
    /**
     * Show view for exchange logbook
     */
    #[Route('/log', name: 'log')]
    public function historial(): Response
    {
        return $this->render('app_vue/history.html.twig');
    }

    /**
     * Stores exchange data
     */

    #[Route('/save/log', name: 'save_log')]
    public function createLog(Request $request,EntityManagerInterface $entityManager): Response
    {
        try {

            $request = Request::createFromGlobals();
            $data = $request->toArray();
            $log = new ExchangeLog();
            $log->setOldAmount($data['old_amount']);
            $log->setOldCurrency($data['old_currency']);
            $log->setNewAmount($data['new_amount']);
            $log->setNewCurrency($data['new_currency']);
            $log->setNewCurrency($data['new_currency']);
            $log->setUuid($data['uuid']);
            $log->setCreatedAt(new DateTime('now'));

            $entityManager->persist($log);
            $entityManager->flush();

            return new Response("Conversion guardada", 201);
        } catch (Exception $e) {
            return new Response((string) $e->getMessage(), 400);
        }
        

        
    }

    /**
     * retrive data to show
     */

    #[Route('/get/log', name: 'get_log')]
    public function getLog(EntityManagerInterface $entityManager): Response
    {
        try {
            $repository = $entityManager->getRepository(ExchangeLog::class);
            $logs = $repository->findBy([], ['id' => 'desc']);
            $data = [];
            
            foreach ($logs as $l) {
                $data[$l->getUuid()][] = [
                    "old_amount" => $l->getOldAmount(),
                    "old_currency" => $l->getOldCurrency(),
                    "new_amount" => $l->getNewAmount(),
                    "new_currency" => $l->getNewCurrency(),
                    "created_at" => $l->getCreatedAt(),
                ];

            }
            return new JsonResponse($data, 201);
        } catch (Exception $e) {
            return new Response((string) $e->getMessage(), 400);
        }
        
    }
}
