<?php
    $sign_name = trim($_GET['name']);
    if (mb_strlen($sign_name) < 3) {
        $sign_name = "  ". $sign_name;
    }
    if (mb_strlen($sign_name) > 3) {
        $sign_name = mb_substr($sign_name, 0, 3);
    }

    $origin_img = './bg.png';
    $bg_img = imagecreatefromstring(file_get_contents($origin_img));
    // $bg_img = imagecreatetruecolor(500,600);

    $font = './zt.ttf'; // 字体

    $font_clr = imagecolorallocate($bg_img, 0, 0, 0); // 字体颜色 RGB
 
    $font_size = 16;   // 字体大小
    $circleSize = 0;   // 旋转角度
    $left = 350;       // 左边距
    $top = 520;        // 顶边距
 
    imagefttext($bg_img, $font_size, $circleSize, $left, $top, $font_clr, $font, $sign_name);
    imagefttext($bg_img, $font_size - 6, $circleSize, $left, $top + 20, $font_clr, $font, date("Y.m.d"));
 
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
        case 3: // jpg
            header('Content-Type:image/png');
            imagepng($bg_img);
            break;
        default:
            break;
    }
    imagedestroy($bg_img);