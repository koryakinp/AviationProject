<?php

class Display {
    public static function displayPagination($totalItems, $curPage, $href, $itemPerPage) {
        if ($totalItems > $itemPerPage) {
            echo '<span class="pagination">Pages: <span class="pageNumbers">';
            $totalPages = ceil($totalItems / $itemPerPage);
            if ($totalPages <= 6) {
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $curPage)
                        echo '<span>' . $i . '</span>';
                    else
                        echo '<a ' . $href . '&page=' . $i . '>' . $i . '</a>';
                }
            } else {
                echo '<a ' . $href . '' . $curItem . '&page=1>1</a>';
                echo ' ... ';
                for ($i = $totalPages - 3; $i <= $totalPages; $i++) {
                    if ($i == $curPage)
                        echo '<span>' . $i . '</span>';
                    else
                        echo '<a ' . $href . '&page=' . $i . '>' . $i . '</a>';
                }
            }
            echo '</span></span>';
        }
    }

    public static function displayOnlineStatus($lastActiveDate) {
        $t = time();
        if (time() > $lastActiveDate + 3600) {
            echo '<span class="offline state">Offline</span>';
        } else {
            echo '<span class="online state">Online</span>';
        }
    }

    public static function displaySelect($keyValuePairs, $attributes = '', $selectedVal = '') {
        echo '<select '.$attributes.'>';
        foreach ($keyValuePairs as $valueMember => $displayMember) {
            if($selectedVal == $valueMember){
                echo '<option selected value=' . $valueMember . ' >' . $displayMember . '</option>';
            } else {
                echo '<option value=' . $valueMember . ' >' . $displayMember . '</option>';
            }
        }
        echo '</select>';
    }
    
    public static function diplayTimeDifference($past, $present){
        $diff = $present - $past;
        if($diff > 60 * 60 * 24){
            echo '<span>'.ceil($diff/(60 * 60 * 24)).' day(s) ago</span>';
        } else if($diff > 60 * 60) {
            echo '<span>'.ceil($diff/(60 * 60)).' hour(s) ago</span>';
        } else if($diff > 60) {
            echo '<span>'.ceil($diff/60).' minutes(s) ago</span>';
        } else {
            echo '<span>'.$diff.' seconds(s) ago</span>';
        }                     
    }
}
