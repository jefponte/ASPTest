<?php
            
/**
 * @author Jefferson Uchôa Ponte
 */
     
namespace ASPTest\dao;
use PDO;
use PDOException;
use ASPTest\model\User;

class UserDAO extends DAO {  
            
    public function update(User $user)
    {
        $id = $user->getId();
            
            
        $sql = "UPDATE user
                SET
                name = :name,
                last_name = :lastName,
                email = :email,
                age = :age,
                password = :password
                WHERE user.id = :id;";
			$name = $user->getName();
			$lastName = $user->getLastName();
			$email = $user->getEmail();
			$age = $user->getAge();
			$password = $user->getPassword();
            
        try {
            
            $stmt = $this->getConnection()->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":age", $age, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
            
    }
            
            

    public function insert(User $user){
        $sql = "INSERT INTO user(name, last_name, email, age, password) VALUES (:name, :lastName, :email, :age, :password);";
		$name = $user->getName();
		$lastName = $user->getLastName();
		$email = $user->getEmail();
		$age = $user->getAge();
		$password = $user->getPassword();
		try {
			$db = $this->getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":age", $age, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			return $stmt->execute();
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
            
    }

	public function fetch() {
		$list = array ();
		$sql = "SELECT user.id, user.name, user.last_name, user.email, user.age, user.password FROM user LIMIT 1000";

        try {
            $stmt = $this->connection->prepare($sql);
            
		    if(!$stmt){   
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		        return $list;
		    }
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row) 
            {
		        $user = new User();
                $user->setId( $row ['id'] );
                $user->setName( $row ['name'] );
                $user->setLastName( $row ['last_name'] );
                $user->setEmail( $row ['email'] );
                $user->setAge( $row ['age'] );
                $user->setPassword( $row ['password'] );
                $list [] = $user;

	
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
        return $list;	
    }
    public function fillById(User $user) {
        
	    $id = $user->getId();
	    $sql = "SELECT user.id, user.name, user.last_name, user.email, user.age, user.password FROM user
                WHERE user.id = :id
                 LIMIT 1000";
                
        try {
            $stmt = $this->connection->prepare($sql);
                
		    if(!$stmt){
                echo "<br>Mensagem de erro retornada: ".$this->connection->errorInfo()[2]."<br>";
		    }
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ( $result as $row )
            {
                $user->setId( $row ['id'] );
                $user->setName( $row ['name'] );
                $user->setLastName( $row ['last_name'] );
                $user->setEmail( $row ['email'] );
                $user->setAge( $row ['age'] );
                $user->setPassword( $row ['password'] );
                return $user;
                
		    }
		} catch(PDOException $e) {
		    echo $e->getMessage();
 		}
		return false;
    }
}