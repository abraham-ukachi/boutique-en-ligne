<?php

class User
{
    public ?int $id = null;
    public ?string $firstname = null;
    public ?string $lastname = null;
    public ?string $mail = null;
    public ?string $password = null;
    public ?string $dob = null;
    public ?string $created_at = null;
    private PDO $db;

    public function __construct()
    {
        $db_dsn = 'mysql:host=localhost; dbname=db_maxaboom';
        $username = 'root';
        strpos($_SERVER['HTTP_USER_AGENT'], 'Macintosh') !== false ? $password_db = 'root' : $password_db = '';

        try {
            $options =
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // BE SURE TO WORK IN UTF8
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //ERROR TYPE
                    PDO::ATTR_EMULATE_PREPARES => false // FOR NO EMULATE PREPARE (SQL INJECTION)
                ];
            $this->db = new PDO($db_dsn, $username, $password_db, $options);
        } catch (PDOException $e) {
            print "Erreur! :" . $e->getMessage() . "</br>";
            die();
        }
    }

    public function register($firstname, $lastname, $mail, $password)
    {
        if (!$this->verifUser()) {
            $sql = "INSERT INTO utilisateurs (firstname, lastname, mail, password)
                    VALUES (:login, :prenom, :nom, :password, :rangs, :bio)";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'login' => htmlspecialchars($login),
                'prenom' => htmlspecialchars($prenom),
                'nom' => htmlspecialchars($nom),
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'rangs' => htmlspecialchars($rangs),
                'bio' => htmlspecialchars($bio),
            ]);

            if ($sql_exe) {
                header("Refresh:2; url=connexion.php");
                echo json_encode(['response' => 'ok', 'reussite' => 'Inscription réussie.']);
            } else {
                echo json_encode(['response' => 'not ok', 'echoue' => 'L\'inscription a échoué.']);
            }
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'L\'utilisateur existe déjà']);
        }
    }

    /* Méthode qui permet de vérifier que l'utilisateur existe ou non en BDD
        On vérifie si le login est déjà présent dans la base de données
        Si $results possède une correspondance on return true sinon false
        On appelle la fonction dans la fonction register pour vérifier avant d'insérer ou non
    */
    public function verifUser()
    {
        if ($_POST['prenom'] > 3 && $_POST['nom'] > 3 && $_POST['login'] > 3) {
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $login = htmlspecialchars($_POST['login']);
            $sql = "SELECT * 
                    FROM utilisateurs
                    WHERE login = :login";
            $sql_exe = $this->db->prepare($sql);
            $sql_exe->execute([
                'login' => $login,
            ]);
            $results = $sql_exe->fetch(PDO::FETCH_ASSOC);
            if ($results) {
                return true;
            } else {
                return false;
            }
        }
    }



}
?>