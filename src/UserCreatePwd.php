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
        $this->setDescription("Update password.")
        ->addArgument('id', InputArgument::REQUIRED, "User's id")
        ->addArgument('password', InputArgument::REQUIRED, "User's password")
        ->addArgument('retypePassword', InputArgument::REQUIRED, "User's retype password")
            ->setHelp("Update password");

    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $id = intval($input->getArgument('id'));
        $selected = new User();
        $selected->setId($id);
        $userDao = new UserDAO();
        if(!$userDao->fillById($selected)){
            $output->writeln("User not found");
            return;
        }
        
        $password = $input->getArgument('password');
        $retypePassword = $input->getArgument('retypePassword');

        if($password != $retypePassword){
            $output->writeln("Enter two same passwords");
            return;
        }
        if(strlen($password) < 6){
            $output->writeln("Password must be at least 6 characters long.");
            return;
        }
        $password = password_hash($password, PASSWORD_BCRYPT, 
        array('cost' => 10));
        $selected->setPassword($password);
        if ($userDao->update($selected)) {
            $output->writeln("Password update sucess.");
            return;
        } else {
            $output->writeln("DB fail.");
            return;
        }
    }
}
