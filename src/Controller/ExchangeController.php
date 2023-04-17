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

class ExchangeController extends AbstractController
{
    #[Route('/log', name: 'log')]
    public function historial(): Response
    {
        return $this->render('app_vue/history.html.twig');
    }

    #[Route('/save/log', name: 'save_log')]
    public function createLog(Request $request,EntityManagerInterface $entityManager): Response
    {
        $request = Request::createFromGlobals();
        $data = $request->toArray();
        
        $log = new ExchangeLog();
        $log->setOldAmount($data['old_amount']);
        $log->setOldCurrency($data['old_currency']);
        $log->setNewAmount($data['new_amount']);
        $log->setNewCurrency($data['new_currency']);

        $entityManager->persist($log);
        $entityManager->flush();

        return new Response("Conversion guardada");
    }

    #[Route('/get/log', name: 'get_log')]
    public function getLog(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(ExchangeLog::class);
        $logs = $repository->findBy([], ['id' => 'desc']);
        
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($logs, 'json');
        return new JsonResponse($jsonContent);
    }
}
