<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste photos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <a href="index.php" class="link">Ajouter un enfant</a>
        <?php
            //inclure la page de connexion
            include_once "con_bdd.php";
            //afficher la liste des photos qui sont dans la base de donnée
            $req = mysqli_query($con , "SELECT * FROM images2");

            //verifier que la liste n'est pas vide
            if(mysqli_num_rows($req) < 1){
                ?>
                <p class="vide_message">La liste des enfants est vide.</p>
                <?php
            }

            //afficher la liste des photos
            while($row = mysqli_fetch_assoc($req)){
                ?>         
                    <div class="box">
                        <img  class="img_principal" src="image_bdd/<?=$row['IMAGE']?>">
                        <div>Nom de l'enfant :<?=$row['TXT']?></div>
                        <div>Post-Nom de l'enfant :<?=$row['TXT2']?></div>
                        <div>Nom du père :<?=$row['TXT3']?></div>
                        <div>Adresse de l'enfant :<?=$row['TXT4']?></div>
                        <div>Ecole de l'enfant :<?=$row['TXT5']?></div>
                        <div>Nom du parain<?=$row['TXT6']?></div>
                        <a class="delete_btn" href="delete.php?id=<?=$row['ID']?>">
                            <img src="remove.png">
                        </a>
                    </div>
                <?php
            }
        ?>

    </section>
</body>
</html>