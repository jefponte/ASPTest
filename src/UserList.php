<?php

namespace ASPTest;

use ASPTest\dao\UserDAO;
use ASPTest\model\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserList extends Command
{
    protected static $defaultName = 'user:list';

    protected function configure()
    {
        $this->setDescription("Users List.")
            ->setHelp("Users List");
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $userDao = new UserDAO();
        $list = $userDao->fetch();
        $listagem = array();
        foreach ($list as $linha) {
            $listagem[] = array(
                'id' => $linha->getId(),
                'name' => $linha->getName(),
                'lastName' => $linha->getLastName(),
                'email' => $linha->getEmail(),
                'age' => $linha->getAge(),
                'password' => $linha->getPassword()
            );
        }
        $output->writeln(json_encode($listagem));
    }
}
