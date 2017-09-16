<?php

namespace AppBundle\Command;


use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName("app:create-user")
            ->setDescription("Creates a new user.")
            ->setHelp("This command allows you to create a user...")
            ->addArgument(
                "username",
                InputArgument::REQUIRED,
                "The username of the user."
            )->addArgument(
                "password",
                InputArgument::REQUIRED,
                "The password of the user."
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Creating a user...");

        $user = new User();
        $user->setEmail($input->getArgument("username"));
        $user->setPlainPassword($input->getArgument("password"));
        $em = $this->getContainer()->get("doctrine")->getManager();
        $em->persist($user);
        $em->flush();
        $output->writeln("User created.");
    }

}