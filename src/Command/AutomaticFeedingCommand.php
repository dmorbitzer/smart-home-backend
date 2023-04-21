<?php

namespace App\Command;

use App\Entity\FeedingTime;
use App\Service\InsertFeedingMessageServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use function Symfony\Component\Clock\now;

#[AsCommand(
    name: 'sh:feed:auto',
    description: 'Add a short description for your command',
)]
class AutomaticFeedingCommand extends Command
{
    /** @var EntityManagerInterface  */
    private EntityManagerInterface $entityManager;

    /** @var InsertFeedingMessageServiceInterface  */
    private InsertFeedingMessageServiceInterface $insertFeedingMessageService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param InsertFeedingMessageServiceInterface $insertFeedingMessageService
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        InsertFeedingMessageServiceInterface $insertFeedingMessageService
    ) {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->insertFeedingMessageService = $insertFeedingMessageService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $feedingTimeRepository = $this->entityManager->getRepository(FeedingTime::class);

        $date = date('w', now()->getTimestamp());
        $time = date('H:i', now()->getTimestamp()) . ':00';

        $feedingTimes = $feedingTimeRepository->findBy(['weekDay' => $date, 'time' => date_create($time)]);

        foreach ($feedingTimes as $feedingTime) {
            $this->insertFeedingMessageService->insert(
                $feedingTime->getCat()->getId(),
                $feedingTime->getFood()->getId(),
                InsertFeedingMessageServiceInterface::AUTOMATIC_MODE
            );
        }

        $io->success(sprintf('Added %d messages at day: %d time: %s', count($feedingTimes), $date, $time));

        return Command::SUCCESS;
    }
}
