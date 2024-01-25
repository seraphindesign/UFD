<?php 
    //inclure la page de connexion
    include_once "con_bdd.php";
    //verifier que les données sont envoyés
    if(isset($_POST['send'])){
        //verifiez que l'image et le texte ont été choisies
        if(!empty($_FILES['image']) && isset($_POST['text']) && $_POST['text']!= ""){
            
            //On récupère d'abord le nom de l'image
            $img_nom = $_FILES['image']['name'];

            //Nous définissons un nom temporaire
            $tmp_nom = $_FILES['image']['tmp_name'];

            //On récupère l'heure actuelle
            $time = time();

            //On rennomme l'image en utilisant cette formule : heure + nom de l'image (Pour avoir des images uniques)
            $nouveau_nom_img = $time.$img_nom ;

            //on déplace l'image dans un dossier appellé "image_bdd"
            $deplacer_img = move_uploaded_file($tmp_nom,"image_bdd/".$nouveau_nom_img);

            if($deplacer_img){
                //si l'image a été mis dans le dossier 
                //insérons le texte et le nom de l'image dans la base de données
                $text = $_POST['text'] ;
                $text2 = $_POST['text2'] ;
                $text3 = $_POST['text3'] ;
                $text4 = $_POST['text4'] ;
                $text5 = $_POST['text5'] ;
                $text6 = $_POST['text6'] ;
                $req = mysqli_query($con , "INSERT INTO images2 VALUES (NULL ,'$nouveau_nom_img','$text','$text2','$text3','$text4','$text5','$text6')");
                //verifier que la requête fonctionne
                if($req){
                    //si oui , faire une redirection vers la page liste.php
                    header("location:liste.php") ;
                }else {
                    //si non
                    $message = "Echec de l'ajout de l'image !";
                }
            }else {
                //si non
                $message = "Veuillez choisir une image avec une taille inférieur à 1Mo !";
            }

        }else {
            //si les champs sont vides on affiche un message
            $message = "Veuillez remplir tous les champs !";
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="liste.php" class="link">Liste des enfants</a>
    <p class="error">
        <?php 
           //afficher une erreur si la variable message existe
           if(isset($message)) echo $message ;
        ?>
    </p>
    <form action="" method="POST" enctype="multipart/form-data"> 
        <label>Ajouter un enf</label>
        <input type="file" name="image">
        <label>Description de l'enfant</label>
        <input placeholder="Nom de l'enfant :" name="text" type="text"></input>
        <input placeholder="Post-Nom de l'enfant :" name="text2" type="text"></input>
        <input placeholder="Nom du père :" name="text3" type="text"></input>
        <input placeholder="Adresse de l'enfant :" name="text4" type="text"></input>
        <input placeholder="Ecole de l'enfant :" name="text5" type="text"></input>
        <input placeholder="Nom du parain :" name="text6" type="text"></input>
        <input type="submit" value="Ajouter" name="send">
    </form>
</body>
</html>