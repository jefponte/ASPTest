<?php

namespace ASPTest;

use ASPTest\dao\ASPTestUserDAO;
use ASPTest\dao\UserDAO;
use ASPTest\model\ASPTestUser;
use ASPTest\model\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCreate extends Command
{

    protected function configure()
    {
        $this->setName('user:create')
        ->addArgument('name', InputArgument::REQUIRED, "User's first name")
        ->addArgument('lastName', InputArgument::REQUIRED, "User's last name")
        ->addArgument('email', InputArgument::REQUIRED, "User's email")
        ->addArgument('age', InputArgument::OPTIONAL, "User's age")
            ->setDescription("Create a new user")
            ->setHelp("Create a new user");
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User();
        $user->setName($input->getArgument('name'));
        $user->setLastName($input->getArgument('lastName'));
        $user->setEmail($input->getArgument('email'));
        $user->setAge($input->getArgument('age'));

        $userDao = new UserDAO();
        if ($userDao->insert($user)) {
            
            $user->setId($userDao->getConnection()->lastInsertId());
            $user = json_encode(array(
                'id' => $user->getId(),
                'name' => $user->getName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'age' => $user->getAge()
            ));
            $output->writeln(json_encode($user));
        } else {
            $output->writeln("Database Error");
        }
    }
}
