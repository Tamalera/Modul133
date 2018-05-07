<?php
class Picture extends Model
{
    public function addPicture($caption)
    {
        //Set directory to save file(s)
        $imageDirectory = ROOT . "images/";

        //Add timestamp -> unique
        $pictureNormal = $_FILES["picUpload"]["name"];

        $checkImage = getimagesize($_FILES["picUpload"]["tmp_name"]);

        //No errors and picture not empty:
        if ($checkImage && !(empty($pictureNormal)) && ($_FILES['picUpload']['error'] == 0))
        {
            // get extension of the file and check it
            $imageFileType = strtolower(substr($pictureNormal, strpos($pictureNormal, '.'), + 1));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                //check for picture size:
                $size = $_FILES['picUpload']['size'];
                if ($size < 4000000) {

                    //Give picture unique name ->timestamp
                    $pictureNormalUnique = $imageDirectory.time().'_'.$pictureNormal;
                    //upload normal picture
                    move_uploaded_file($_FILES["picUpload"]["tmp_name"], $pictureNormalUnique);

                    //Resize picture to smaller size:


                    //upload small pictures

                    //Save everything in DB
                    $sql = "INSERT INTO picture (pictureNormal, pictureSmall, pictureText) 
                            VALUES ( :pictureNormal, :pictureSmall, :pictureText)";
                    $req = Database::getBdd()->prepare($sql);
                    $req->execute([
                        'pictureNormal' => $pictureNormalUnique,
                        'pictureSmall' => "TBD",
                        'pictureText' => $caption
                    ]);
                }
            }
        }
    }
}
?>