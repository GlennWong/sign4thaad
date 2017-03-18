<?php
    $sign_name = trim($_GET['name']);
    $font_type = intval($_GET['type']) ? intval($_GET['type']) : 1;

    if (mb_strlen($sign_name) > 3) {
        $sign_name = mb_substr($sign_name, 0, 3);
    }
    if (mb_strlen($sign_name) < 3) {
        $sign_name = "  ". $sign_name;
    }

    $origin_img = './bg.png';
    $bg_img = imagecreatefromstring(file_get_contents($origin_img));
    // $bg_img = imagecreatetruecolor(500,600);

    $font = './zt' . $font_type . '.ttf'; // 字体

    $font_clr = imagecolorallocate($bg_img, 0, 0, 0); // 字体颜色 RGB
 
    $font_size = 28;   // 字体大小
    $circleSize = 0;   // 旋转角度
    $left = 330;       // 左边距
    $top = 520;        // 顶边距
 
    imagefttext($bg_img, $font_size, $circleSize, $left, $top, $font_clr, $font, $sign_name);
    imagefttext($bg_img, $font_size - 6, $circleSize, $left - 15, $top + 40, $font_clr, $font, date("Y.m.d"));
 
    list($bg_width, $bg_hight, $img_type) = getimagesize($origin_img);
    switch ($img_type) {
        case 1: // gif
            header('Content-Type:image/gif');
            imagegif($bg_img);
            break;
        case 2: // jpg
            header('Content-Type:image/jpg');
            imagejpeg($bg_img);
            break;
        case 3: // png
            header('Content-Type:image/png');
            // header("Content-type:text/html;charset=utf-8"); 
            $src = imagepng($bg_img);
            break;
        default:
            break;
    }
    imagedestroy($bg_img);

?>