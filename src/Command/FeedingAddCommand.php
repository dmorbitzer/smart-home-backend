<?php

namespace App\Command;

use App\Message\CatFeedingServiceMessage;
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

    /**
     * @param MessageBusInterface $bus
     */
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct();
        $this->bus = $bus;
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

        $catFeedMessage = new CatFeedingServiceMessage($catId, $foodId, 'manuell');
        $this->bus->dispatch($catFeedMessage);

        $io->success('You added a new cat feeding message to the rabbitmq!');

        return Command::SUCCESS;
    }
}
