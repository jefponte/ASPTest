<?php
            
/**
 * Classe feita para manipulação do objeto User
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace ASPTest\model;

class User {
	private $id;
	private $name;
	private $lastName;
	private $email;
	private $age;
	private $password;
    public function __construct(){

    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setName($name) {
		$this->name = $name;
	}
		    
	public function getName() {
		return $this->name;
	}
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
		    
	public function getLastName() {
		return $this->lastName;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
		    
	public function getEmail() {
		return $this->email;
	}
	public function setAge($age) {
		$this->age = $age;
	}
		    
	public function getAge() {
		return $this->age;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
		    
	public function getPassword() {
		return $this->password;
	}
	public function __toString(){
	    return $this->id.' - '.$this->name.' - '.$this->lastName.' - '.$this->email.' - '.$this->age.' - '.$this->password;
	}
                

}
?>