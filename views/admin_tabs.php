<div id="icon-themes" class="icon32"><br></div>
<h2 class="nav-tab-wrapper">
<?php
foreach( $tabs as $tab => $name ){
    $class = ( $tab == $current ) ? ' nav-tab-active' : '';
    echo "<a class='nav-tab$class' href='?page=wpgroupmenu&tab=$tab'>$name</a>";
}
?>
</h2>
