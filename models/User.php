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
  // Define some constants
  const SESSION_NAME = 'user';


  // Define some properties
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

        // check if the user is connected
        if($this->isConnected()){
          // get the user id from session as `userId`
          $userId = $this->getSession('id');

          // populate the user info with `userId`
          $this->populateUserInfo($userId);
        }

    }


    // PUBLIC SETTERS
    // PUBLIC GETTERS
    // PUBLIC METHODS
  
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

    /**
     * Function that verif if user id exist in bdd
     * @param $id
     * @return int
     */
    public function verifUserById($id): int{
        $sql = "SELECT * FROM users WHERE id = :id";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'id' => $id,
        ]);
        $results = $sql_exe->fetch(PDO::FETCH_ASSOC);
        if($results){
            return true;
        }else{
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


        //method for admin for create user
    public function createUser($firstname, $lastname, $mail, $password, $checkpassword, $role)
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
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => $created_at,
                'user_role' => htmlspecialchars($role)
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

        // fetch the result as `user`
        $user = $sql_exe->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashed_password = $user['password'];
            if (password_verify($password, $hashed_password)) {

              // create session
              $this->createSession([
                'id' => $user['id'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'mail' => $user['mail']
              ]);

                // $userId = $results['id'];
                // $_SESSION['id'] = $userId;
                $this->populateUserInfo($user['id']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function disconnect() {
      $result = false;

      // Check the session
      
      // If there's a session..
      if ($this->checkSession()) {
        // .. destroy it
        $this->destroySession();
        // set the result to true
        $result = true;
      }

      return $result;
    }



  /**
   * Checks if the user is connected
   *
   * @return bool
   */
  public function isConnected(): bool {
    // initialize the `result` variable
    $result = false;
    
    // Check the session 
    
    // If there's a session..
    if($this->checkSession()){
      // get the user id from session as `userId`
      $userId = $this->getSession('id');
      // vertify the user id
      $result = $this->verifUserById($userId);

      // if the user id is not valid
      if(!$result){
        // destroy the session
        $this->destroySession();
      }

    }

    // return the result
    return $result;
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

        public function updateMail(string $newmail, int $userId){
            //$mail=$_SESSION['mail'];
            $sqlupdate = $this->db->prepare("UPDATE users SET mail = :newmail WHERE id = :userId ");
            $result = $sqlupdate->execute([
              'newmail' => $newMail,
              'userId' => $userId
            ]);
            //$_SESSION['mail'] = $newmail;

            // update session
            $this->setSession('mail', $newmail);

            // return "Vous avez changer votre email et mis à jour votre profil.<br>";
            // return the `$result`
            return $result;

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

    public function getUserInfo(int $userId) {
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
        return $result;
    }


    //update user
    public function updateUser($id, $firstname,$lastname, $mail, $user_role){
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, mail = :mail,
        user_role = :user_role WHERE id = :id";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'id' => $id,
            'firstname' => htmlspecialchars($firstname),
            'lastname' => htmlspecialchars($lastname),
            'mail' => htmlspecialchars($mail),
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
        $sql="DELETE FROM users WHERE id = :iduser";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'iduser' => $idUser
        ]);         
        if ($sql_exe) {
            return json_encode(['response' => 'ok', 'reussite' => 'Utilisateur supprimé']);
        } else {
            return json_encode(['response' => 'not ok', 'echoue' => 'Problème']);
        }
    }

    public function getInitials(){
        $firstnameInitials  = $this->firstname[0] ?? '';
        $lastnameInitials = $this->lastname[0] ?? '';
        return strtolower($firstnameInitials).strtolower($lastnameInitials);
    }


    /**
     * Method used to check if the current user is an admin
     *
     * @return bool - Returns TRUE if the user is an admin, FALSE otherwise
     */ 
    public function isAdmin(): bool {
      // do nothing if the user is not connected
      if (!$this->isConnected()) {
        return false;
      }

      // check if the user is an admin
      $isAdmin = $this->user_role === self::ROLE_ADMIN;

      // return `$isAdmin` value
      return $isAdmin;
    }

    /**
     * Returns the date of birth of the user
     *
     * @param bool $useDateFormat - If set to TRUE, the current `dateFormat` will be used when the user has no date of birth
     * @param string $dateFormat - The date format to use when the user has no date of birth
     * 
     * @return string 
     */
    public function getDateOfBirth(bool $useDateFormat = false, string $dateFormat = 'DD/MM/YYYY'): string {
      return $this->dob ?? ($useDateFormat ? $dateFormat : '');
    }


    /**
     * Returns the first name of the user
     *
     * @return string
     */
    public function getFirstName(): string {
      return $this->firstname ?? '';
    }


    /**
     * Returns the last name of the user
     *
     * @return string
     */
    public function getLastName(): string {
      return $this->lastname ?? '';
    }

    /**
     * Returns the user's full name
     *
     * @param bool $reversed - if TRUE, the name will be reversed (i.e. "Lastname Firstname")
     *
     * @return string - the user's full name
     */
    public function getFullname(bool $reversed = false): string {
      return ($this->isConnected()) ? $this->firstname . ' ' . $this->lastname : '';
    }

    /**
     * Returns the email of the user
     *
     * @return string
     */
    public function getEmail(): string {
      return $this->mail ?? '';
    }

    public function usersCount(){
        $displayUsers = $this->db->prepare("SELECT COUNT(*) FROM users");
        $displayUsers->execute([
        ]);
        $result = $displayUsers->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



  // PRIVATE SETTERS

  /**
   * Sets the user's session data
   *
   * @param string $key - The key of the session variable to set (eg. `id`)
   * @param mixed $value - The value of the session variable to set (eg. `3`)
   *
   * @return void
   */
  private function setSession(string $key, mixed $value): void {
    // If the session does not exist, create it
    if ($this->checkSession() === false) { $this->createSession(); }

    // Set the given `$key` session variable to the given `$value`
    $_SESSION[self::SESSION_NAME][$key] = $value;
  }


  // PRIVATE GETTERS
  
  /**
   * Returns the user's session data if the `$key` parameter is NULL, 
   * or the value of the session variable corresponding to the `$key` parameter if not
   *
   * @param string|null $key - The key of the session variable to return
   *
   * @return mixed 
   */
  private function getSession(?string $key = null): mixed {
    return is_null($key) ? ($_SESSION[self::SESSION_NAME] ?? []) : ($_SESSION[self::SESSION_NAME][$key] ?? null);
  }


  // PRIVATE METHODS

  /**
   * Creates a session for the current user
   * NOTE: This method creates a `user` session variable
   *
   * @param array $user - The user data to store in the session (eg. `['id' => 1, 'firstname' => 'John']`)
   *
   * @return void
   */
  private function createSession(array $user): void {
    // If there is no `user` session variable
    if (!isset($_SESSION[self::SESSION_NAME])) {
      // Create the `user` session variable
      $_SESSION[self::SESSION_NAME] = [];
    }

    // Set the `user` session variable to the `$user` value
    $_SESSION[self::SESSION_NAME] = $user;
  }

  /**
   * Checks if the current user has a session
   * NOTE: This method checks if the `user` session variable exists,
   *       or if the `user` session variable has a specific `key`
   *
   * @param string|null $key - The key of the session variable to check
   *
   * @return bool - Returns TRUE if the session or specified `key` exists, FALSE otherwise, 
   */
  private function checkSession(?string $key = null): bool {
    return is_null($key) ? isset($_SESSION[self::SESSION_NAME]) : isset($_SESSION[self::SESSION_NAME][$key]);
  }


  /**
   * Destroys the session of the current user
   * NOTE: This method only destroys the `user` session variable
   *
   * @return void
   */
  private function destroySession(): void {
    // Destroy the session
    // session_destroy();

    // Unset the `user` session variable
    unset($_SESSION[self::SESSION_NAME]);
  }


}


