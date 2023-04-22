<?php
function cleanNote($note){
    $smileTexts = array(":)", ":(", ":o", ":D", ":/");
    $smileImages = array("<img src='imgs/smiling-face.png' width='20px' height='20px'>"
     ,"<img src='imgs/sad.png' width='20px' height='20px'>"
     , "<img src='imgs/surprised.png' width='20px' height='20px'>"
     , "<img src='imgs/smile.png' width='20px' height='20px'>"
     , "<img src='imgs/unknow.png' width='20px' height='20px'>");

    $note = str_replace($smileTexts, $smileImages, $note);
    return $note;
}

?>