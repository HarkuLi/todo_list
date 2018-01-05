<ul class="pagination">
    <?php
    // previous page button
    if ($page <= $paginationStart) {
        echo "<li class=\"disabled\">";
        echo "<span class=\"glyphicon glyphicon-triangle-left\"></span>";
        echo "</li>";
    } else {
        echo "<li>";
        echo "<a href=\"/task?page=".($page-1)."\">";
        echo "<span class=\"glyphicon glyphicon-triangle-left\"></span>";
        echo "</a>";
        echo "</li>";
    }
    
    // pagination buttons
    for ($i=$paginationStart; $i<=$paginationEnd; ++$i) {
        if ($i === $page) {
            echo "<li class=\"active\"><a href=\"/task?page=$i\">$i</a></li>";
        } else {
            echo "<li><a href=\"/task?page=$i\">$i</a></li>";
        }
    }

    //next page button
    if ($page >= $paginationEnd) {
        echo "<li class=\"disabled\">";
        echo "<span class=\"glyphicon glyphicon-triangle-right\"></span>";
        echo "</li>";
    } else {
        echo "<li>";
        echo "<a href=\"/task?page=".($page+1)."\">";
        echo "<span class=\"glyphicon glyphicon-triangle-right\"></span>";
        echo "</a>";
        echo "</li>";
    }
    ?>
</ul>