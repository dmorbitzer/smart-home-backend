<?php

namespace App\Controller;

use App\Service\InsertFeedingMessageServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ManuellFeedingController extends AbstractController
{
    private InsertFeedingMessageServiceInterface $feedingMessageService;

    /**
     * @param InsertFeedingMessageServiceInterface $feedingMessageService
     */
    public function __construct(InsertFeedingMessageServiceInterface $feedingMessageService)
    {
        $this->feedingMessageService = $feedingMessageService;
    }

    #[Route('/feeding_service/manuell', name: 'sh_manuell_feeding', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $params = json_decode($request->getContent());
        $catId = $params->catId;
        $foodId = $params->foodId;

        if (!isset($catId) || !isset($foodId)) {
            return $this->json(['status' => 'error', 'msg' => 'Missing parameters', 'code' => 1]);
        }
        $this->feedingMessageService->insert($catId, $foodId, InsertFeedingMessageServiceInterface::MANUELL_MODE);
        return $this->json(['status' => 'ok']);
    }
}
