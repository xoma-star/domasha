<?php
    if (!empty($_COOKIE['uid'])) {
        if (file_exists('../hw/'.$_POST['w'].'.txt')) {
            $week_data = json_decode(file_get_contents('../hw/'.$_POST['w'].'.txt'));
            if (is_numeric($_POST['d']) && is_numeric($_POST['l'])) {
                $lesson_data = $week_data->response->days[$_POST['d']]->subjects[$_POST['l']];
                $img = $lesson_data->images;
                $pos = array_search($_POST['src'], $lesson_data->images);
                if ($pos !== false) {
                    array_splice($lesson_data->images, $pos, 1);
                }
                include 'log.php';
                loger('image_remove',$lesson_data->images,$img);
                $week_data->response->days[$_POST['d']]->subjects[$_POST['l']]->images = $lesson_data->images;
                file_put_contents('../hw/'.$_POST['w'].'.txt', json_encode($week_data));
            }
        }
    }
?>