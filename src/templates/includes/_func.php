<?php
function get_image_format_class($product_shot) {

    $image_format_class = "";

    $product_w = $product_shot->width();
    $product_h = $product_shot->height();

    if($product_w != $product_h){
        $image_format_class .= " rect";

        if($product_w > $product_h)
        {   
            $image_format_class .= " rect--l";
        } else {
            $image_format_class .= " rect--p";
        }   
    } else {
        $image_format_class .= " sq";
    }

    return $image_format_class;
}