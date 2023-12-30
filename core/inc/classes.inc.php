<?php
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * core/classes.inc.php
 * 
*/
Class Skolkov_Fonctions
{
  
  public function SkolkovLogin ($identifiant)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT * FROM membres WHERE NOM =:IDENTIFIANT LIMIT 1");
      $query->bindParam("IDENTIFIANT", $identifiant, PDO::PARAM_STR);
      $query->execute();
      //$data = $query->fetchColumn();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      //$data = $query->fetchAll();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
      }
  }
          
  public function SkolkovMembreAjout($user_name, $user_secret)
  {
    try {
      $db = DB();
      $query = $db->prepare("INSERT INTO membres (NOM, SECRET) VALUES (:NOM, :SECRET)");
      $query->bindParam("NOM", $user_name, PDO::PARAM_STR);
      $query->bindParam("SECRET", $user_secret, PDO::PARAM_STR);
      $query->execute();
      //$data = $query->fetchColumn();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      //$data = $query->fetchAll();
      //return $data;
      return $db->lastInsertId();
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
      }
  }
          
  public function SkolkovCompteurDebut ($membre_id, $compteur_texte, $compteur_id_tache)
  {
    try {
      $date_creation = date('Y-m-d H:i:s');
      $etat = 1;
      
      $db = DB();
      $query = $db->prepare("INSERT INTO compteurs (ID_MEMBRE, DATE_DEBUT, TEXTE, ETAT, ID_TACHE) 
      VALUES (:ID_MEMBRE, :DATE_DEBUT, :TEXTE, :ETAT, :ID_TACHE)");
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->bindParam("DATE_DEBUT", $date_creation, PDO::PARAM_STR);
      $query->bindParam("TEXTE", $compteur_texte, PDO::PARAM_STR);
      $query->bindParam("ETAT", $etat, PDO::PARAM_STR);
      $query->bindParam("ID_TACHE", $compteur_id_tache, PDO::PARAM_STR);
      $query->execute();
      return $db->lastInsertId();
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
          
  //get avatar string from ID
  public function SkolkovAvatarString ($avatar_id)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT * FROM avatars WHERE ID =:ID LIMIT 1");
      $query->bindParam("ID", $avatar_id, PDO::PARAM_STR);
      $query->execute();
      //$data = $query->fetchColumn();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      //$data = $query->fetchAll();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  public function SkolkovMembreDoublon($user_name)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT * FROM membres WHERE NOM =:NOM LIMIT 1");
      $query->bindParam("NOM", $user_name, PDO::PARAM_STR);
      $query->execute();
      //$data = $query->fetchColumn();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      //$data = $query->fetchAll();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  } 
          
  public function SkolkovTacheDoublon ($membre_id, $tache_titre)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT * FROM taches WHERE ID_MEMBRE =:ID_MEMBRE AND TITRE =:TITRE LIMIT 1");
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->bindParam("TITRE", $tache_titre, PDO::PARAM_STR);
      $query->execute();
      //$data = $query->fetchColumn();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      //$data = $query->fetchAll();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  } 
          
  public function SkolkovTacheAjout ($membre_id, $tache_titre)
  {
    try {
      $etat = 1;
      $db = DB();
      $query = $db->prepare("INSERT INTO taches (ID_MEMBRE, TITRE, DISPONIBLE)
       VALUES (:ID_MEMBRE, :TITRE, :DISPONIBLE)");
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->bindParam("TITRE", $tache_titre, PDO::PARAM_STR);
      $query->bindParam("DISPONIBLE", $etat, PDO::PARAM_BOOL);
      $query->execute();
      return $db->lastInsertId();
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
          
  // chercher toutes les compteurs disponibles ou non ($etat) du membre      
  public function SkolkovMembreCompteurs($membre_id, $etat)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT * FROM compteurs WHERE ID_MEMBRE =:ID_MEMBRE AND ETAT =:ETAT ORDER BY DATE_DEBUT DESC");
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->bindParam("ETAT", $etat, PDO::PARAM_STR);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
      } catch (PDOException $e) {
          file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
            exit;
    }
  }
           
  public function SkolkovMembreCompteursCompte($membre_id)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT COUNT(*) FROM compteurs WHERE ID_MEMBRE =:ID_MEMBRE");
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->execute();
      $data = $query->fetchColumn();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  public function SkolkovMembreTachesArchiveCompte($membre_id, $etat)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT COUNT(*) FROM taches WHERE ID_MEMBRE =:ID_MEMBRE AND DISPONIBLE =:DISPONIBLE");
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->bindParam("DISPONIBLE", $etat, PDO::PARAM_STR);
      $query->execute();
      $data = $query->fetchColumn();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  // chercher toutes les compteurs qui ont cette tache
  public function SkolkovQuelCompteursPourCetteTache($tache_id)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT * FROM compteurs WHERE ID_TACHE =:ID_TACHE");
      $query->bindParam("ID_TACHE", $tache_id, PDO::PARAM_STR);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  public function SkolkovQuelCompteursActifsPourCetteTache($tache_id)
  {
    try {
      $etat = 1;
      $db = DB();
      $query = $db->prepare("SELECT * FROM compteurs WHERE ID_TACHE =:ID_TACHE AND ETAT =:ETAT");
      $query->bindParam("ID_TACHE", $tache_id, PDO::PARAM_STR);
      $query->bindParam("ETAT", $etat, PDO::PARAM_INT);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  // chercher toutes les taches disponibles ou non ($etat) du membre
  public function SkolkovTachesMembre($membre_id, $etat)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT * FROM taches WHERE ID_MEMBRE =:ID_MEMBRE AND DISPONIBLE =:DISPONIBLE");
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->bindParam("DISPONIBLE", $etat, PDO::PARAM_STR);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  // tous les avatars d'un membre
  public function SkolkovMembreAvatars($membre_id)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT * FROM avatars WHERE ID_MEMBRE =:ID_MEMBRE");
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->execute();
      $data = $query->fetchAll();
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  // chercher le nom de la tache du compteur via TACHE_ID
  public function SkolkovCompteurTache($compteur_tache_id)
  {
    try {
      $db = DB();
      $query = $db->prepare("SELECT * FROM taches WHERE ID =:ID LIMIT 1");
      $query->bindParam("ID", $compteur_tache_id, PDO::PARAM_STR);
      $query->execute();
      $data = $query->fetch(PDO::FETCH_ASSOC);
      return $data;
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  public function SkolkovCompteurFin($compteur_id)
  {
    try {
      $date_fin = date('Y-m-d H:i:s');
      $etat = 0;
      $db = DB();
      $query = $db->prepare("UPDATE compteurs SET DATE_FIN=:DATE_FIN, ETAT=:ETAT WHERE ID =:ID");
      $query->bindParam("ID", $compteur_id, PDO::PARAM_STR);
      $query->bindParam("DATE_FIN", $date_fin, PDO::PARAM_STR);
      $query->bindParam("ETAT", $etat, PDO::PARAM_BOOL);
      $query->execute();
      //return $db->lastInsertId();
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  public function SkolkovTacheArchiver ($membre_id, $tache_id, $tache_total)
  {
    try {
      $etat = 0;
      $db = DB();
      $query = $db->prepare("UPDATE taches SET DISPONIBLE=:DISPONIBLE, TOTAL=:TOTAL WHERE ID =:ID AND ID_MEMBRE =:ID_MEMBRE");

      $query->bindParam("ID", $tache_id, PDO::PARAM_STR);
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->bindParam("TOTAL", $tache_total, PDO::PARAM_STR);
      $query->bindParam("DISPONIBLE", $etat, PDO::PARAM_BOOL);
      $query->execute();
      //return $db->lastInsertId();
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  public function SkolkovDateSyntaxHMS ($duree)
  {
    //$duree_h = gmdate("H:i:s", $duree);
    $duree_h = gmdate("H", $duree);
    $duree_m = gmdate("i", $duree);
    $duree_s = gmdate("s", $duree);
    $duree = $duree_h."h ".$duree_m."min ".$duree_s."s";
    return $duree;
  }
  
  public function SkolkovDateSyntaxDMH ($date)
  {
    $mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin","Juillet","Aout", "Septembre", "Octobre", "Novembre", "Decembre");
    $date_mo = date("m", $date);
    $date_mo = $mois[intval($date_mo)-1];
    $date_d = date("d", $date);
    $date_h = date("H:i:s", $date);
    $date_syntax = $date_d. " " .$date_mo. " " .$date_h;
    return $date_syntax;
  }
  
  public function SkolkovNouvelAvatar($membre_id, $avatar)
  {
    try {
      $db = DB();
      $query = $db->prepare("INSERT INTO avatars SET ID_MEMBRE=:ID_MEMBRE, AVATAR=:AVATAR");
      $query->bindParam("ID_MEMBRE", $membre_id, PDO::PARAM_STR);
      $query->bindParam("AVATAR", $avatar, PDO::PARAM_STR);
      $query->execute();
      return $db->lastInsertId();
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
  
  public function SkolkovMembreAvatar($membre_id, $avatar_id)
  {
    try {
      $db = DB();
      $query = $db->prepare("UPDATE membres SET AVATAR=:AVATAR WHERE ID =:ID");
      $query->bindParam("AVATAR", $avatar_id, PDO::PARAM_STR);
      $query->bindParam("ID", $membre_id, PDO::PARAM_STR);
      $query->execute();
      //return $db->lastInsertId();
      } catch (PDOException $e) {
        file_put_contents('./log/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        exit;
    }
  }
 
  public function AvatarRandomString()
  {
    $length = 20;
    $keys = array_merge(range(0,9), range('a', 'z'));
    $key = "";
    for($i=0; $i < $length; $i++) {
      $key .= $keys[mt_rand(0, count($keys) - 1)];
      }
      return $key;
  }
 
          
}
?>
