<?php print_r(get_post_types() );?> 
<div class="wpgroupmenu">
    <div class="wpgroupmenu_nav">
        <ul>
            <?php foreach($menus as $menu):?>
            <li>
                <a href="<?=$menu->siteUrl; ?>"
               	    <?php if($menu->siteId == $siteID):?> class="current"<?php endif;?>
             	    <?php if($menu->siteTarget == "blank"):?> target="_blank"<?php endif;?>
             	    <?php if($menu->siteAlt != ""):?> title="<?=$menu->siteAlt;?>"<?php endif;?>
                >
                    <span><?=$menu->siteName;?></span>
                </a>
            </li>
           <?php endforeach; ?>
        </ul>
    </div>
    <div class="wpgroupmenu_mobi">
        <div class="wpgroupmenu_nav wpgroupmenu_toggle">
            <ul>
                <li>
                    <a href="#">
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </a>
                </li>
            </ul>
        </div>
        <nav role="navigation" class="wpgroupmenu_nav closed">
            <ul>
                <?php foreach($menus as $menu): ?>
                <li>
                    <a href="<?=$menu->siteUrl; ?>"
                		 <?php if($menu->siteId == $siteID):?> class="current"<?php endif;?>
                		 <?php if($menu->siteTarget == "blank"):?> target="_blank"<?php endif;?>
                		 <?php if($menu->siteAlt != ""):?> title="<?=$menu->siteAlt;?>"<?php endif;?>
                	>
                    <span><?=$menu->siteName;?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</div>
