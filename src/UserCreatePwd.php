<?php

namespace ASPTest;

use ASPTest\dao\UserDAO;
use ASPTest\model\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCreatePwd extends Command
{
    protected static $defaultName = 'user:create-pwd';

    protected function configure()
    {
        $this->setDescription("Cria uma senha para um usuário.")
            ->addArgument('id', InputArgument::OPTIONAL, "User's id")
            ->setHelp("Criar uma senha para um usuário");

    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->edit();
        $output->writeln("Senha alterada com sucesso!");
        return Command::SUCCESS;
    }



    public function edit()
    {
        $id = 1;
        $password = "Teste";
        $password = password_hash($password, PASSWORD_BCRYPT, 
        array('cost' => 10));
        

        $selected = new User();
        $selected->setId($id);
        $userDao = new UserDAO();
        if(!$userDao->fillById($selected)){
            return false;
        }

        $selected->setPassword($password);

        if ($userDao->update($selected)) {
            return true;
        } else {
            return false;
        }
    }
}
