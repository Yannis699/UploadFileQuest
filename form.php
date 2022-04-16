<?php


if(isset($_POST['send']))
{
    // Erreur globale, notamment l'envoi d'aucun fichier. 

  if($_FILES['avatar']['error']>0)
  {
      echo 'Une erreur est survenue lors du transfert veuillez recommencer';
      die();
  }

  //gestion de la taille des images. 

  $maxSize = 1000000; 
  $fileSize = $_FILES['avatar']['size'];

  if($fileSize>$maxSize)
  {
      echo 'votre fichier est trop volumineux, il pèse ' . $fileSize . ' alors qu\'il ne devrait pas dépasser ' . $maxSize ;
      die();
  }

  //Gestion du format des images. 

  $validImg = array('.jpg', '.gif', '.png', '.webp');
  $fileName = $_FILES['avatar']['name'];

  $fileExt = "." . strtolower(substr(strrchr($fileName, '.'), 1));
  if(!in_array($fileExt, $validImg))
  {
      echo 'Le fichier n\'est pas une image au format approprié';
      die();
  }

  // genèse d'un nom de fichier aléatoire et unique

  $tmpName = $_FILES['avatar']['tmp_name'];
  $uniqueId = md5(uniqid(rand(), true));
  $fileDir = 'upload/' . $uniqueId . $fileExt;
  $result = move_uploaded_file($tmpName, $fileDir);

  if($result)
  {
      Echo 'Le transfert s\'est bien déroulé';
      die();
  }
 

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-5">
                    <h2>Upload your profile picture</h2>
                    <div class="form-group" method="POST" enctype= "multipart/form-data">

                    <div class="d-grid gap-2 col-6 mx-auto mt-5">
                            <label for="firstname" class="form-label">Firstname : </label>
                            <input type="text" name="firstname" id="firstname" class="form-control"/>
                                        

                            <label for="lastname" class="form-label">Lastname : </label>
                            <input type="text" name="lastname" id="lastname" class="form-control"/>

                            <label for="age" class="form-label">Age : </label>
                            <input type="number" name="age" id="age" min="18" max="100" class="form-control"/>
                    </div>
                        <div class="d-grid gap-2 col-6 mx-auto mt-5">
                        <form method="post" enctype="multipart/form-data">
                            <label for="imageUpload">Upload your profile image</label><br>    
                            <input class = 'mt-3' type="file" name="avatar" id="imageUpload" />
                        </div>
                        <div class="d-grid gap-2 col-2 mx-auto mt-5">
                            <button name="send" class='rounded shadow bg-primary text-white'>Send</button>
                        </div>
                    </div>     
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>


</html>