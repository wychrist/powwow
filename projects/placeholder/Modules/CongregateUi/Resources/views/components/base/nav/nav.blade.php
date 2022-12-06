<?php



function walkMenuItem($entries, int $level)
{
    static $menuLevelIcons = ['far fa-circle fa-fw', 'fas fa-circle fa-fw', 'far fa-dot-circle  fa-fw', 'fas fa-dot-circle  fa-fw',];


    if (count($entries)) {
        foreach ($entries as $item) {
            $children = $item->getChildren();
            $open = ($item->isActive() || $item->getHasActiveChild()) ? 'menu-open' : '';
            echo "<li class=\"nav-item {$open}\">";

            $active = $item->isActive() ? 'active' : '';
            if ($level == 0) {
                if ($item->getHasActiveChild()) {
                    $active = 'active';
                }
            }
            $link = $children ? '#' : $item->getLink();
            echo "<a href=\"{$link}\" class=\"nav-link {$active}\">";

            echo '<i class="';
            echo $menuLevelIcons[$level % count($menuLevelIcons)];
            echo ' nav-icon"></i>';
            echo "<p>{$item->getLabel()}";
            if ($children) {
                echo '<i class="right fas fa-angle-left"></i>';
            }
            echo "</p>";
            echo '</a>';
            if ($children) {
                echo '<ul class="nav nav-treeview">';
                walkMenuItem($children, $level + 1);
                echo '</ul>';
            }
            echo '</li>';
        }
    }
}
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <?php walkMenuItem($mainMenu, 0); ?>
    </ul>
</nav>