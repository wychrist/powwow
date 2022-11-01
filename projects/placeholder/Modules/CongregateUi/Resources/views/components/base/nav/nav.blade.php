<?php
function walkMenuItem($entries, bool $first = false)
{
    if ($first) {
        echo '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';
        foreach ($entries as $item) {
            echo '<li class="nav-item">';
            $active = $item->isActive() ? 'active' : '';
            echo "<a href=\"{$item->getLink()}\" class=\"nav-link {$active}\">";
            echo '<i class="nav-icon fas fa-th"></i>';
            echo "<p>{$item->getLabel()}</p>";
            echo '</a>';
            walkMenuItem($item->getChildren());
            echo '</li>';
        }
        echo '</ul>';
    } elseif (count($entries)) {
        echo '<ul class="nav nav-treeview" style="display: block;">';
        foreach ($entries as $item) {
            echo '<li class="nav-item">';
            $active = $item->isActive() ? 'active' : '';
            echo "<a href=\"{$item->getLink()}\" class=\"nav-link {$active}\">";
            echo '<i class="nav-icon fas fa-th"></i>';
            echo "<p>{$item->getLabel()}</p>";
            echo '</a>';
            walkMenuItem($item->getChildren());
            echo '</li>';
        }
        echo '</ul>';
    }
}
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php walkMenuItem($mainMenu, true); ?>
    </ul>
</nav>
