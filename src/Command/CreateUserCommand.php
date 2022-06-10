<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'CreateUser',
    description: 'Create a user',
)]
class CreateUserCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $users
    ) {
        parent::__construct();
    }


    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        // SymfonyStyle is an optional feature that Symfony provides so you can
        // apply a consistent look to the commands of your application.
        // See https://symfony.com/doc/current/console/style.html
        $this->io = new SymfonyStyle($input, $output);
    }


    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::OPTIONAL, 'Set a username')
            ->addArgument('password', InputArgument::OPTIONAL, 'Set a password')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'If set, the user is created as an administrator');
    }



    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $plainPassword = $input->getArgument('password');
        $isAdmin = $input->getOption('admin');

        $user = new User();
        $user->setUsername($username);
        $user->setRoles([$isAdmin ? 'ROLE_ADMIN' : 'ROLE_USER']);
        $user->setPassword($plainPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('User created');

        return Command::SUCCESS;
    }
}
