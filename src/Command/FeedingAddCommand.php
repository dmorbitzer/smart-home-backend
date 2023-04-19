<?php

namespace App\Command;

use App\Message\CatFeedingServiceMessage;
use App\Service\InsertFeedingMessageServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'sh:feed:add',
    description: 'Add a cat feeding message to the rabbitmq',
)]
class FeedingAddCommand extends Command
{
    /** @var MessageBusInterface  */
    private MessageBusInterface $bus;

    /** @var InsertFeedingMessageServiceInterface  */
    private InsertFeedingMessageServiceInterface $insertFeedingMessageService;

    /**
     * @param MessageBusInterface $bus
     */
    public function __construct(
        MessageBusInterface $bus,
        InsertFeedingMessageServiceInterface $insertFeedingMessageService
    ) {
        parent::__construct();
        $this->bus = $bus;
        $this->insertFeedingMessageService = $insertFeedingMessageService;
    }


    protected function configure(): void
    {
        $this
            ->addArgument('catId', InputArgument::REQUIRED, 'The Cat Id')
            ->addArgument('foodId', InputArgument::REQUIRED, 'The Food Id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $catId = $input->getArgument('catId');
        $foodId = $input->getArgument('foodId');

        $this->insertFeedingMessageService->insert(
            $catId,
            $foodId,
            InsertFeedingMessageServiceInterface::MANUELL_MODE
        );

        $io->success('You added a new cat feeding message to the rabbitmq!');

        return Command::SUCCESS;
    }
}
