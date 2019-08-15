<?php
function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 60)
{  
    if (!file_exists($src))
        return false;
 
    $size = getimagesize($src);
      
    if ($size === false)
        return false;
 
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
    $icfunc = 'imagecreatefrom'.$format;
     
    if (!function_exists($icfunc))
        return false;
 
    $x_ratio = $width  / $size[0];
    $y_ratio = $height / $size[1];
     
    if ($height == 0)
    { 
        $y_ratio = $x_ratio;
        $height  = $y_ratio * $size[1];
    }
    elseif ($width == 0)
    { 
        $x_ratio = $y_ratio;
        $width   = $x_ratio * $size[0];
    }
     
    $ratio       = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);
     
    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
      
    // если не нужно увеличивать маленькую картинку до указанного размера
    if ($size[0]<$new_width && $size[1]<$new_height)
    {
        $width = $new_width = $size[0];
        $height = $new_height = $size[1];
    }
 
    $isrc  = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);
      
    imagefill($idest, 0, 0, $rgb);
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);
 
    $i = strrpos($dest,'.');
    if (!$i) return '';
    $l = strlen($dest) - $i;
    $ext = substr($dest,$i+1,$l);
     
    switch ($ext)
    {
        case 'jpeg':
        case 'jpg':
        imagejpeg($idest,$dest,$quality);
        break;
        case 'gif':
        imagegif($idest,$dest);
        break;
        case 'png':
        imagepng($idest,$dest);
        break;
    }
 
    imagedestroy($isrc);
    imagedestroy($idest);
 
    return true;  
}
for ($n=0; $n < 8; $n++) { 
	$num .= mt_rand(0,9);
}
$md5num = md5($num);
if (!empty($_COOKIE['uid'])) {
    if (in_array($_FILES['file']['type'], ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/webp'])) {
        if(move_uploaded_file($_FILES['file']['tmp_name'], '../img/uploads/'.$md5num.'.jpg')){
            list($width, $height) = getimagesize('../img/uploads/'.$md5num.'.jpg');
            img_resize('../img/uploads/'.$md5num.'.jpg', '../img/uploads/'.$md5num.'.jpg', $width, $height);
            if (file_exists('../hw/'.$_POST['w'].'.txt')) {
                $week_data = json_decode(file_get_contents('../hw/'.$_POST['w'].'.txt'));
                if (is_numeric($_POST['d']) && is_numeric($_POST['l'])) {
                    $lesson_data = $week_data->response->days[$_POST['d']]->subjects[$_POST['l']];
                    $lesson_data->images[count($lesson_data->images)] = 'https://domasha.tk/img/uploads/'.$md5num.'.jpg';
                    $week_data->response->days[$_POST['d']]->subjects[$_POST['l']] = $lesson_data;
                    file_put_contents('../hw/'.$_POST['w'].'.txt', json_encode($week_data));
                    include 'log.php';
                    loger('add_photo','https://domasha.tk/img/uploads/'.$md5num.'.jpg');
                    echo 'https://domasha.tk/img/uploads/'.$md5num.'.jpg';
                }
            }
        }
    }
}
?>