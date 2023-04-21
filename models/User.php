<?php
/**
* @license MIT
* boutique-en-ligne (maxaboom)
* Copyright (c) 2023 Abraham Ukachi, Axel Vair, Morgane Marechal, Catherine Tranchand. The Maxaboom Project Contributors.
* All rights reserved.
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* @project boutique-en-ligne (maxaboom)
* @name User - Model
* @test test/user.php
* @file User.php
* @author: Morgane Marechal <morgane.marechal@laplateforme.io>
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Axel Vair <axel.vair@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Get all users
*    -|>
*    -|> 
*/


// declare a namespace for this User class
namespace Maxaboom\Models;


// use these classes
use Maxaboom\Models\Helpers\Database;
use datetime;
use PDO;
use PDOException;


// create a User class that extends the Database class
class User extends Database
{
    public ?int $id = null;
    public ?string $firstname = null;
    public ?string $lastname = null;
    public ?string $mail = null;
    public ?string $password = null;
    public ?string $dob = null;
    public ?string $created_at = null;
    public ?string $user_role = null;

    public function __construct()
    {
        parent::__construct();
        // $this->setDatabaseUsername('root');
        // $this->setDatabasePassword('root');
        // $this->setDatabasePort(8888);

        // connect to the database
        $this->dbConnect();
        if($this->isConnected()){
            $this->populateUserInfo($_SESSION['id']);
        }
    }

    //method for register user
    public function register($firstname, $lastname, $mail, $password)
    {
        $user_role = "customer";
        if (!$this->verifUser($mail)) {
            $created_at = $this->getCurrentDate();
            $sql = "INSERT INTO users (firstname, lastname, mail, password, created_at, user_role)
                    VALUES (:firstname, :lastname, :mail, :password, :created_at, :user_role)";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'firstname' => htmlspecialchars($firstname),
                'lastname' => htmlspecialchars($lastname),
                'mail' => htmlspecialchars($mail),
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => $created_at,
                'user_role' => htmlspecialchars($user_role),
            ]);

            if ($sql_exe) {
               return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /* Check if user in DB */
    public function verifUser($mail)
    {
            $sql = "SELECT * 
                    FROM users
                    WHERE mail = :mail";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'mail' => $mail,
            ]);
            $results = $sql_exe->fetch(PDO::FETCH_ASSOC);
            if ($results) {
                return true;
            } else {
                return false;
            }
    }

    //call registerGuest() if no SESSION_ID when pay product   
    public function registerGuest($firstname, $lastname, $mail)
    {
        if (!$this->verifGuest()) {
            $created_at = $this->getCurrentDate();
            $sql = "INSERT INTO users (firstname, lastname, mail, user_role, created_at) VALUES (:firstname, :lastname, :mail, :user_role, :created_at)";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'firstname' => htmlspecialchars($firstname),
                'lastname' => htmlspecialchars($lastname),
                'mail' => htmlspecialchars($mail),
                'user_role' => 'guest',
                'created_at' => $created_at
            ]);

            if ($sql_exe) {
                //header("Refresh:2; url=connection.php");
                echo json_encode(['response' => 'ok', 'reussite' => 'Inscription réussie.']);
            } else {
                echo json_encode(['response' => 'not ok', 'echoue' => 'L\'inscription a échoué.']);
            }
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Vous avez un compte utilisateur, vous devez vous connecter']);
        }
    }

    public function verifGuest()
    {
            $mail = htmlspecialchars($_POST['mail'] ?? '');
            $sql = "SELECT * 
                    FROM users
                    WHERE mail = :mail";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'mail' => $mail,
            ]);
            $results = $sql_exe->fetch(PDO::FETCH_ASSOC);
            if ($results) {
                if ($results["user_role"]==="customer"){
                    return true;
                }else{
                    return false;
                }               
            } else {
                return false;
            }
    }

    // method get current date
    public function getCurrentDate(){
        $mydate=getdate(date("U"));
        $myhour=date("H:i:s");
        $monthdate=$mydate['mon'];
        $dday=$mydate['mday'];
        $mon = str_pad($monthdate, 2, "0", STR_PAD_LEFT);
        $day = str_pad($dday, 2, "0", STR_PAD_LEFT);

        $date="$mydate[year]-$mon-$day $myhour";
        return $date;
    }

    //method get lastGuestId

    public function connection($mail, $password)
    {
        $sql = "SELECT * 
                FROM users
                WHERE mail = :mail ";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'mail' => $mail,
        ]);
        $results = $sql_exe->fetch(PDO::FETCH_ASSOC);
        if ($results) {
            $hashed_password = $results['password'];
            if (password_verify($password, $hashed_password)) {
                session_start();
                $userId = $results['id'];
                $_SESSION['id'] = $userId;
                $this->populateUserInfo($userId);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isConnected(){
        return isset($_SESSION['id']);
    }


    public function populateUserInfo($id){
        $sql = "SELECT * FROM users WHERE id = $id";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([]);
        $info = $sql_exe->fetch(PDO::FETCH_ASSOC);

        $this->id = $info['id'];
        $this->firstname = $info['firstname'];
        $this->lastname = $info['lastname'];
        $this->mail = $info['mail'];
        $this->user_role = $info['user_role'];
    }

    //methods for update info user

        // update lastname
        public function updateLastname($newlastname){
            $lastname=$_SESSION['lastname'];
            $sqlupdate = $this -> db -> prepare("UPDATE users SET lastname = '$newlastname' WHERE lastname = :lastname ");
            $sqlupdate->execute([
                'lastname' => $lastname,
            ]);
            $_SESSION['lastname'] = $newlastname;
            return "Vous avez changer votre nom et mis à jour votre profil.<br>";
        }

        // update firstname
        public function updateFirstname($newfirstname){
            $firstname=$_SESSION['firstname'];
            $sqlupdate = $this -> db -> prepare("UPDATE users SET firstname = '$newfirstname' WHERE firstname = :firstname ");
            $sqlupdate->execute([
                'firstname' => $firstname,
            ]);
            $_SESSION['firstname'] = $newfirstname;
            return "Vous avez changer votre prénom et mis à jour votre profil.<br>";
        } 

        public function updateMail($newmail){
            $mail=$_SESSION['mail'];
            $sqlupdate = $this -> db -> prepare("UPDATE users SET mail = '$newmail' WHERE mail = :mail ");
            $sqlupdate->execute([
                'mail' => $mail,
            ]);
            $_SESSION['mail'] = $newmail;
            return "Vous avez changer votre email et mis à jour votre profil.<br>";
        }


    //display all users for admin
        public function displayUsers(){
            $displayUsers = $this->db->prepare("SELECT * FROM " . $this::TABLE_USERS);
            $displayUsers->execute([
            ]);
            $result = $displayUsers->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    //display one specific user by id

    public function getUserId(int $userId): array {
        $userData = [];

        try {
            $query = "SELECT * FROM `users` WHERE id = '$userId'";
            $pdo_stmt = $this->db->query($query, PDO::FETCH_ASSOC);
            $result = $pdo_stmt->fetch();
            // update the product data
            $productData = $result;

        } catch (PDOException $e) {
            // TODO: handle the exception
        }
        return $userData;
    }


    //update user
    public function updateUser($id, $firstname,$lastname, $mail, $dob, $user_role){
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, mail = :mail, dob = :dob,
        user_role = :user_role, update_at = :update_at, stock = :stock WHERE id = :id";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'id' => $id,
            'firstname' => htmlspecialchars($firstname),
            'lastname' => htmlspecialchars($lastname),
            'mail' => htmlspecialchars($mail),
            'dob' => $dob,
            'user_role' => htmlspecialchars($user_role),
        ]);         
        if ($sql_exe) {
            echo json_encode(['response' => 'ok', 'reussite' => 'Utilisateur modifié']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Problème enregistrement']);
        }
    }

    //delete user

    public function deleteUser($idUser){
        $sql="DELETE users WHERE id = :iduser";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'iduser' => $idUser
        ]);         
        if ($sql_exe) {
            echo json_encode(['response' => 'ok', 'reussite' => 'Utilisateur supprimé']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Utilisateur enregistrer']);
        }
    }


}
