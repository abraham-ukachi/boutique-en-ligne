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
    }

    //method for register user
    public function register($firstname, $lastname, $mail, $password, $user_role)
    {
        if (!$this->verifUser($mail)) {
            $created_at = $this->getCurrentDate();
            $sql = "INSERT INTO users (firstname, lastname, mail, password, created_at, user_role)
                    VALUES (:firstname, :lastname, :mail, :password, :created_at, :user_role)";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'firstname' => htmlspecialchars($firstname),
                'lastname' => htmlspecialchars($lastname),
                'mail' => htmlspecialchars($mail),
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'created_at' => $created_at,
                'user_role' => htmlspecialchars($user_role),
            ]);

            if ($sql_exe) {
                header("Refresh:2; url=connexion.php");
                echo json_encode(['response' => 'ok', 'reussite' => 'Inscription réussie.']);
            } else {
                echo json_encode(['response' => 'not ok', 'echoue' => 'L\'inscription a échoué.']);
            }
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Vous vous êtes déjà inscrit avec ce mail']);
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
                $_SESSION['id'] = $results['id'];
                $_SESSION['firstname'] = $results['firstname'];
                $_SESSION['lastname'] = $results['lastname'];
                $_SESSION['user_role'] = $results['user_role'];
                echo json_encode(['response' => 'ok', 'reussite' => 'connexion réussie']);
                die();
            }else{
               echo json_encode(['response' => 'bad password', "password" => "mot de passe incorrect"]);
            }
        } else {
            echo json_encode(['response' => 'not ok', 'echec' => 'connexion refusée']);
        }
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




}
