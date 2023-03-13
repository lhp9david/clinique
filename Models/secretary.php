<?php 

// créer une class Secretary
class Secretary
{
    private int $secretary_id;
    private string $secretary_login;
    private string $secretary_password;

    private object $_pdo;

    // méthode magique pour get les attributs
    public function __get($attribut)
    {
        return $this->$attribut;
    }

    // méthode magique pour set les attributs
    public function __set($attribut, $value)
    {
        $this->$attribut = $value;
    }

    // créer un constructeur pour instancier la connexion
    public function __construct()
    {
        $this->_pdo = Database::connect();
    }

    // méthode pour se connecter
    public function login()
    {
        // requête pour vérifier si le login et le mot de passe correspondent
        $query = "SELECT * FROM `cl_secretary` WHERE `secretary_login` = :secretary_login AND `secretary_password` = :secretary_password";
        $result = $this->_pdo->prepare($query);
        // assigner les valeurs aux marqueurs nominatifs
        $result->bindValue(':secretary_login', $this->secretary_login, PDO::PARAM_STR);
        $result->bindValue(':secretary_password', $this->secretary_password, PDO::PARAM_STR);
        // exécuter la requête
        $result->execute();
        // vérifier si la requête a retourné un résultat
        if ($result->rowCount() > 0) {
            // assigner les données de la requête à des variables
            $data = $result->fetch(PDO::FETCH_OBJ);
            // assigner les données de la requête aux attributs de l'objet
            $this->secretary_id = $data->secretary_id;
            $this->secretary_login = $data->secretary_login;
            $this->secretary_password = $data->secretary_password;
            // retourner true
            return true;
        } else {
            // retourner false
            return false;
        }
    }

    /**
 * methode pour vérifier si le login existe déjà
 * 
 * @param string $secretary_ login de la secretaire
 * @return mixed array|false
 * 
 */
     
 public static function checkLogin(string $secretary_login) : mixed
 {
     $pdo = Database::connect();
     $query = "SELECT * FROM `cl_secretary` WHERE `secretary_login` = :secretary_login";
     $result = $pdo->prepare($query);
     $result->bindValue(':secretary_login', $secretary_login, PDO::PARAM_STR);
     if ($result->execute()) {
         if ($result->rowCount() > 0) {
             return $result->fetch(PDO::FETCH_ASSOC);
         } else {
             return false;
         }
     }
     else {
         return false;
     }
 }
}
