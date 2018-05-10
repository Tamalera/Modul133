<?php
class Picture extends Model
{
    public function getBlogPictures($blog_id){
        $sql = "SELECT * FROM picture WHERE blogID = :id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute(['id' => $blog_id]);
        return $req->fetchAll();

    }

    public function getOneBlogPicture($pic_id){
        $sql = "SELECT * FROM picture WHERE pictureID = :id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute(['id' => $pic_id]);
        $picture = $req->fetch(PDO::FETCH_ASSOC);
        return $picture['pictureID'];
    }

    public function getAllPictures(){
        $sql = "SELECT * FROM picture";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function deletePicture($pid){
        //Delete picture from folder
        //unlink($file)
        //Delete picture from DB
        $sql = 'DELETE FROM picture WHERE pictureID = ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$pid]);

    }

    public function deletePictureOfBlog($blog_ID){
        //Delete picture from folder
        // $sql = 'SELECT * FROM picture WHERE blog_ID = ?';
        // $req = Database::getBdd()->prepare($sql);
        // $req->execute([$blog_ID]);
        // $req->fetchAll();
        // foreach ($image as $req) {
        //     $big = basename($req['pictureBig']);
        //     $small = basename($req['pictureSmall']);
        //     unlink($big);
        //     unlink($small);
        // }
        //Delete picture from DB
        $sql2 = 'DELETE FROM picture WHERE blog_ID = ?';
        $req2 = Database::getBdd()->prepare($sql2);
        $req2->execute([$blog_ID]);
    }

    public function addPicture($caption)
    {
        //Set directory to save file(s)
        $imageDirectory = ROOT . "images/";

        //Get file name
        $pictureNormal = $_FILES["picUpload"]["name"];

        //Get file size for checking
        $file = $_FILES["picUpload"]["tmp_name"];
        $checkImage = getimagesize($file);

        //No errors and picture not empty:
        if ($checkImage && !(empty($pictureNormal)) && ($_FILES['picUpload']['error'] == 0))
        {
            // get extension of the file and check it
            $imageFileType = strtolower(substr($pictureNormal, strpos($pictureNormal, '.'), + 1));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {

                //check for picture size < 4MB:
                $size = $_FILES['picUpload']['size'];
                if ($size < 4000000) {

                    //Resize picture to bigger size:
                    $image_type = $checkImage[2];

                    //Rename file with unique name
                    $pictureBigUnique = $imageDirectory.time().'_'.$pictureNormal;

                    if( $image_type == IMAGETYPE_JPEG ) {   
                        $image_resource_id = imagecreatefromjpeg($file);  
                        $target_layer = $this->resizeBig($image_resource_id,$checkImage[0],$checkImage[1]);
                        imagejpeg($target_layer, $pictureBigUnique);
                        }
                        elseif( $image_type == IMAGETYPE_GIF )  {  
                        $image_resource_id = imagecreatefromgif($file);
                        $target_layer = $this->resizeBig($image_resource_id,$checkImage[0],$checkImage[1]);
                        imagegif($target_layer,$pictureBigUnique);
                        }
                        elseif( $image_type == IMAGETYPE_PNG ) {
                        $image_resource_id = imagecreatefrompng($file); 
                        $target_layer = $this->resizeBig($image_resource_id,$checkImage[0],$checkImage[1]);
                        imagepng($target_layer,$pictureBigUnique);
                    }
                    
                    //Same for small picture
                    $pictureSmallUnique = $imageDirectory.time().'_Small_'.$pictureNormal;
                    if( $image_type == IMAGETYPE_JPEG ) {   
                        $image_resource_id = imagecreatefromjpeg($file);  
                        $target_layer = $this->resizeSmall($image_resource_id,$checkImage[0],$checkImage[1]);
                        imagejpeg($target_layer, $pictureSmallUnique);
                        }
                        elseif( $image_type == IMAGETYPE_GIF )  {  
                        $image_resource_id = imagecreatefromgif($file);
                        $target_layer = $this->resizeSmall($image_resource_id,$checkImage[0],$checkImage[1]);
                        imagegif($target_layer,$pictureSmallUnique);
                        }
                        elseif( $image_type == IMAGETYPE_PNG ) {
                        $image_resource_id = imagecreatefrompng($file); 
                        $target_layer = $this->resizeSmall($image_resource_id,$checkImage[0],$checkImage[1]);
                        imagepng($target_layer,$pictureSmallUnique);
                    }

                    //Save everything in DB (need first blog_id --> last blog added)

                    $sqlBlog = "SELECT blogID FROM blog ORDER BY blogID DESC LIMIT 1";
                    $reqBlog = Database::getBdd()->prepare($sqlBlog);
                    $reqBlog->execute();
                    $blogidtemp = $reqBlog->fetch(PDO::FETCH_ASSOC);
                    $blog_id = $blogidtemp['blogID'];

                    $sql = "INSERT INTO picture (pictureSmall, pictureBig, pictureText, blog_ID) 
                            VALUES ( :pictureSmall, :pictureBig, :pictureText, :blog_id)";
                    $req = Database::getBdd()->prepare($sql);
                    $req->execute([
                        'pictureSmall' => $pictureSmallUnique,
                        'pictureBig' => $pictureBigUnique,
                        'pictureText' => $caption,
                        'blog_id' => $blog_id
                    ]);
                }
            }
        }
    }

    private function resizeSmall($image_resource_id,$width,$height) {
        $target_width = 100;
        $ratio = $width/$height;
        $target_height = (int)($target_width/$ratio);

        $newSize=imagecreatetruecolor($target_width, $target_height);
        imagecopyresampled($newSize, $image_resource_id,0,0,0,0,$target_width, $target_height, $width, $height);
        return $newSize;
    }

    private function resizeBig($image_resource_id,$width,$height) {
        $target_width = 1000;
        $ratio = $width/$height;
        $target_height = (int)($target_width/$ratio);
        $newSize=imagecreatetruecolor($target_width, $target_height);
        imagecopyresampled($newSize, $image_resource_id,0,0,0,0,$target_width, $target_height, $width, $height);
        return $newSize;
    }
}
?>