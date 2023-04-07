<?php

namespace Api\classUser;

require_once '/Applications/MAMP/htdocs/boutique-en-ligne/api/database/Database.php';

use Api\classDatabase\Database;;
use datetime;
use PDO;
use PDOException;

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
        $this->setDatabasePort(8888);
        $this->setDatabaseUsername('root');
        $this->setDatabasePassword('root');

        // connect to the database
        $this->dbConnect();
    }

    //method for register user
    public function register($firstname, $lastname, $mail, $password, $user_role)
    {
        if (!$this->verifUser()) {
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
    public function verifUser()
    {
            $mail = htmlspecialchars($_POST['mail']);
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
            $sql = "INSERT INTO users (firstname, lastname, mail, user_role, created_at)
                    VALUES (:firstname, :lastname, :mail, :user_role, :created_at)";
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
            $displayUsers = $this->db->prepare("SELECT * FROM users");
            $displayUsers->execute([
            ]);
            $result = $displayUsers->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }




}
