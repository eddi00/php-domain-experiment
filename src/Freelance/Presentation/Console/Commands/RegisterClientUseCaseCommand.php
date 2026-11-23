<?php

declare(strict_types=1);

namespace App\Freelance\Presentation\Console\Commands;

use App\Freelance\Application\UseCases\Client\RegisterClientUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class RegisterClientUseCaseCommand extends Command
{
    public function __construct(
        private RegisterClientUseCase $useCase
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('app:register-client-use-case')
            ->setDescription('Register client use case');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->useCase->execute("test@mail.ru");
            $output->writeln('Use case executed.');

            return self::SUCCESS;
        } catch (Throwable $e) {
            $output->writeln("<error>Failed: " . $e->getMessage() . "</error>");
            return self::FAILURE;
        }
    }
}
