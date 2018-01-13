<?php
try {
	$dbms = "mysql";
	$server = "localhost";
	$base = "Projet";
	$user = "root";
	$pass = "root";
	$dsn = "$dbms:host=$server;dbname=$base";
	$sql = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $e) {
	echo "Erreur de la connexion à la base de données ".$e->getMessage();
	die();
}


/*    Fonctionnalité 1    */
/* Rechercher un aéroport */
# Par le nom
if (isset($_GET['rechercher_nom'])) {
	$nom = $_GET['nom_aero'];
	if (empty($nom)) {
		echo "<script language=\"javascript\">alert(\"Veuillez entrer le nom de l'aéroport !\");location.replace(\"recherche.html\");</script>";
	}
	else{
		$req = $sql->prepare('SELECT * FROM Airports_China INNER JOIN Regions_China ON Airports_China.iso_region = Regions_China.code WHERE name=:nom');
		$req->bindParam(':nom', $nom);
		$resultat = $req->execute();
		if ($resultat) {
			echo "<!DOCTYPE html><html><head><title>Résultat de la recherche</title><meta charset=\"utf-8\"/><style type=\"text/css\">body{text-align: center;} table,th,td{font-size: 18px; font-family: helvetica; border: 2px solid; border-collapse: collapse;}</style></head><body><h1>Aéroport(s) trouvé(s)</h1><table align=\"center\"><tr><th>Identificateur</th><th>Nom</th><th>Type</th><th>Région/Province</th><th>Ville</th><th>Service programmé</th><th>Page web de l'aéroport</th></tr>";
			while ($row = $req->fetch(PDO::FETCH_OBJ)) {
				echo "<tr><td>".$row->ident."</td><td><a href=".$row->wikipedia_link.">".$row->name."</a></td><td>".$row->type."</td><td><a href=".$row->wikipedia_link_region.">".$row->name_region."</a></td><td>".$row->municipality."</td><td>".$row->scheduled_service."</td><td><a href=".$row->home_link.">".$row->home_link."</a></td></tr>";
			}
			echo "</table></body><html>";
		}
		else{
			echo "<script language=\"javascript\">alert(\"Résultat non-trouvé !\");location.replace(\"recherche.html\");</script>";
		}
	}
}

# Par la localisation
if (isset($_GET['recherche_loca'])) {
	$region = $_GET['province'];
	$ville = $_GET['ville'];
	if ($region == 'province') {
		echo "<script language=\"javascript\">alert(\"Veuillez choisir la localisation de l'aéroport !\");location.replace(\"recherche.html\");</script>";
	}
	else{
		$req = $sql->prepare('SELECT * FROM Airports_China INNER JOIN Regions_China ON Airports_China.iso_region = Regions_China.code WHERE name_region=:region AND municipality=:ville');
		$req->bindParam(':region', $region);
		$req->bindParam(':ville', $ville);
		$resultat = $req->execute();
		if ($resultat) {
			echo "<!DOCTYPE html><html><head><title>Résultat de la recherche</title><meta charset=\"utf-8\"/><style type=\"text/css\">body{text-align: center;} table,th,td{font-size: 18px; font-family: helvetica; border: 2px solid; border-collapse: collapse;}</style></head><body><h1>Aéroport(s) trouvé(s)</h1><table align=\"center\"><tr><th>Identificateur</th><th>Nom</th><th>Type</th><th>Région/Province</th><th>Ville</th><th>Service programmé</th><th>Page web de l'aéroport</th></tr>";
			while ($row = $req->fetch(PDO::FETCH_OBJ)) {
				echo "<tr><td>".$row->ident."</td><td><a href=".$row->wikipedia_link.">".$row->name."</a></td><td>".$row->type."</td><td><a href=".$row->wikipedia_link_region.">".$row->name_region."</a></td><td>".$row->municipality."</td><td>".$row->scheduled_service."</td><td><a href=".$row->home_link.">".$row->home_link."</a></td></tr>";
			}
			echo "</table></body><html>";
		}
		else{
			echo "<script language=\"javascript\">alert(\"Résultat non-trouvé !\");location.replace(\"recherche.html\");</script>";
		}
	}
}

# Par le type de l'aéroport
if (isset($_GET['recherche_type'])) {
	$type = $_GET['type'];
	$req = $sql->prepare('SELECT * FROM Airports_China INNER JOIN Regions_China ON Airports_China.iso_region = Regions_China.code WHERE type=:type');
	$req->bindParam(':type', $type);
	$resultat = $req->execute();
	if ($resultat) {
		echo "<!DOCTYPE html><html><head><title>Résultat de la recherche</title><meta charset=\"utf-8\"/><style type=\"text/css\">body{text-align: center;} table,th,td{font-size: 18px; font-family: helvetica; border: 2px solid; border-collapse: collapse;}</style></head><body><h1>Aéroport(s) trouvé(s)</h1><table align=\"center\"><tr><th>Identificateur</th><th>Nom</th><th>Type</th><th>Région/Province</th><th>Ville</th><th>Service programmé</th><th>Page web de l'aéroport</th></tr>";
		while ($row = $req->fetch(PDO::FETCH_OBJ)) {
			echo "<tr><td>".$row->ident."</td><td><a href=".$row->wikipedia_link.">".$row->name."</a></td><td>".$row->type."</td><td><a href=".$row->wikipedia_link_region.">".$row->name_region."</a></td><td>".$row->municipality."</td><td>".$row->scheduled_service."</td><td><a href=".$row->home_link.">".$row->home_link."</a></td></tr>";
		}
	}
	else{
			echo "<script language=\"javascript\">alert(\"Résultat non-trouvé !\");location.replace(\"recherche.html\");</script>";
	}
}

# Par le service régulier
if (isset($_GET['rechercher_service'])) {
	$service = $_GET['service'];
	if (empty($service)) {
		echo "<script language=\"javascript\">alert(\"Veuillez choisir la localisation de l'aéroport !\");location.replace(\"recherche.html\");</script>";
	}
	else{
		$req = $sql->prepare('SELECT * FROM Airports_China INNER JOIN Regions_China ON Airports_China.iso_region = Regions_China.code WHERE scheduled_service=:service');
		$req->bindParam(':service', $service);
		$resultat = $req->execute();
		if ($resultat) {
			echo "<!DOCTYPE html><html><head><title>Résultat de la recherche</title><meta charset=\"utf-8\"/><style type=\"text/css\">body{text-align: center;} table,th,td{font-size: 18px; font-family: helvetica; border: 2px solid; border-collapse: collapse;}</style></head><body><h1>Aéroport(s) trouvé(s)</h1><table align=\"center\"><tr><th>Identificateur</th><th>Nom</th><th>Type</th><th>Région/Province</th><th>Ville</th><th>Service programmé</th><th>Page web de l'aéroport</th></tr>";
			while ($row = $req->fetch(PDO::FETCH_OBJ)) {
				echo "<tr><td>".$row->ident."</td><td><a href=".$row->wikipedia_link.">".$row->name."</a></td><td>".$row->type."</td><td><a href=".$row->wikipedia_link_region.">".$row->name_region."</a></td><td>".$row->municipality."</td><td>".$row->scheduled_service."</td><td><a href=".$row->home_link.">".$row->home_link."</a></td></tr>";
			}
		}
		else{
			echo "<script language=\"javascript\">alert(\"Résultat non-trouvé !\");location.replace(\"recherche.html\");</script>";
		}
	}
}


/*     Fonctionnalité 2     */
/* Insérer des commentaires */
if (isset($_GET['inserer'])) {
	$ident = $_GET['ident'];
	$type = $_GET['type'];
	$contenu = $_GET['comment'];
	if (empty($contenu) || empty($ident)) {
		echo "<script language=\"javascript\">alert(\"Veuillez compléter le formulaire !\");location.replace(\"inserer.html\");</script>";
	}
	else{
		$req = $sql->prepare('INSERT INTO Comments_Airport(id_airport, type_comment, comment) VALUES(:ident, :type, :contenu)');
		$req->bindParam(':type', $type);
		$req->bindParam(':contenu', $contenu);
		$req->bindParam(':ident', $ident);
		$resultat = $req->execute();
		if ($resultat) {
			echo "<script language=\"javascript\">alert(\"Votre commentaire a été enregistré !\");location.replace(\"inserer.html\");</script>";
		}
		else{
			echo "<script language=\"javascript\">alert(\"Enregistrement non-réussi !\");location.replace(\"inserer.html\");</script>";
		}
	}
}


/*      Fonctionnalité 3      */
/* Consulter les commentaires */
if (isset($_GET['consulter'])) {
	$nom_ident = $_GET['nom_ident'];
	$type = $_GET['type'];
	$mot_cle = $_GET['mot-cle'];
	if (empty($nom_ident) && $type=="type" && empty($mot_cle)) {
		echo "<script language=\"javascript\">alert(\"Veuillez compléter au moins un champ !\");location.replace(\"consulter.html\");</script>";
	}
	else{
		if ($type=="type") {
			$type = null;
		}
		if (!empty($mot_cle)) {
			$mot_cle = "%".$mot_cle."%";
		}

		if (!empty($nom_ident) && !empty($type)) {
			$req = $sql->prepare('SELECT * FROM Comments_Airport INNER JOIN Airports_China ON id_airport=ident WHERE (type_comment=:type) AND (name=:nom_ident OR id_airport=:nom_ident)');
			$req->bindParam(':nom_ident', $nom_ident);
			$req->bindParam(':type', $type);
		}
		elseif (!empty($nom_ident) && !empty($mot_cle)) {
			$req = $sql->prepare('SELECT * FROM Comments_Airport INNER JOIN Airports_China ON id_airport=ident WHERE (comment LIKE :mot_cle) AND (name=:nom_ident OR id_airport=:nom_ident)');
			$req->bindParam(':nom_ident', $nom_ident);
			$req->bindParam(':mot_cle', $mot_cle);
		}
		elseif (!empty($type) && !empty($mot_cle)) {
			$req = $sql->prepare('SELECT * FROM Comments_Airport INNER JOIN Airports_China ON id_airport=ident WHERE (type_comment=:type) AND (comment LIKE :mot_cle)');
			$req->bindParam(':type', $type);
			$req->bindParam(':mot_cle', $mot_cle);
		}
		elseif (!empty($nom_ident) || !empty($type) || !empty($mot_cle)){
			$req = $sql->prepare('SELECT * FROM Comments_Airport INNER JOIN Airports_China ON id_airport=ident WHERE (name=:nom_ident OR id_airport=:nom_ident) OR (type_comment=:type) OR (comment LIKE :mot_cle)');
			$req->bindParam(':nom_ident', $nom_ident);
			$req->bindParam(':type', $type);
			$req->bindParam(':mot_cle', $mot_cle);
		}
		else {
			$req = $sql->prepare('SELECT * FROM Comments_Airport INNER JOIN Airports_China ON id_airport=ident WHERE (type_comment=:type) AND (comment LIKE :mot_cle) AND (name=:nom_ident OR id_airport=:nom_ident)');
			$req->bindParam(':nom_ident', $nom_ident);
			$req->bindParam(':type', $type);
			$req->bindParam(':mot_cle', $mot_cle);
		}
		$resultat = $req->execute();
		if ($resultat) {
			echo "<!DOCTYPE html><html><head><title>Résultat de la recherche</title><meta charset=\"utf-8\"/><style type=\"text/css\">body{text-align: center;} table,th,td{font-size: 18px; font-family: helvetica; border: 2px solid; border-collapse: collapse;}</style></head><body><h1>Commentaire(s) trouvé(s)</h1><table align=\"center\"><tr><th>Id Aéroport</th><th>Nom Aéroport</th><th>Type Commentaire</th><th>Commentaire</th></tr>";
			while ($row = $req->fetch(PDO::FETCH_OBJ)) {
				echo "<tr><td>".$row->ident."</td><td>".$row->name."</a></td><td>".$row->type_comment."</td><td>".$row->comment."</td></tr>";
			}
		}
		else{
			echo "<script language=\"javascript\">alert(\"Résultat non-trouvé !\");location.replace(\"consulter.html\");</script>";
		}
	}
}
?>