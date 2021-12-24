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
        $name = $input->getArgument('name');
        $lastName = $input->getArgument('lastName');
        $email = $input->getArgument('email');
        $age = intval($input->getArgument('age'));

        if (strlen($name) < 2) {
            $output->writeln("Type a name longer than 1");
            return;
        }
        if (strlen($name) > 35) {
            $output->writeln("Type a name shorter than 35");
            return;
        }

        if (strlen($lastName) < 2) {
            $output->writeln("Type a last name longer than 1");
            return;
        }
        if (strlen($lastName) > 35) {
            $output->writeln("Type a last name shorter than 35");
            return;
        }
        if ($age < 2) {
            $output->writeln("Age must be between 2 and 35");
            return;
        }
        if ($age > 150) {
            $output->writeln("Age must be between 2 and 35");
            return;
        }
        
        if (!$this->validaEmail($email)) {
            $output->writeln("Type a valid mail");
            return;
        }

        $user->setName($name);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setAge($age);

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

    function validaEmail($email)
    {
        $conta = "^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$";

        if(preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(.[[:lower:]]{2,3})(.[[:lower:]]{2})?$/", $email)) {
            return true;
        }else{
            return false;
        }
    }
}
