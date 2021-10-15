<?php 

function pagination($row, $num, $menu){
    $page_num = ceil($row/5);
    for($i = 1; $i <= $page_num; $i++) {
        echo "<li class='btn mr-1 ". ($num == $i || ($num == 0 && $i == 1) ? 'btn-primary' : 'btn-secondary')." btn-sm'><a href='index.php?p=".$menu."&num=$i' ". ($num == $i || ($num == 0 && $i == 1) ? 'class="active text-white font-weight-bold"' : 'class="text-white"').">$i</a></li>";
    }
}
