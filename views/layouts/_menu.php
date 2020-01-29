<?php

use app\components\Widget;
// use yii\widgets\Menu;
use mdm\admin\components\MenuHelper;

$callback = function ($menu) {
    $data = json_decode($menu['data'], true);
    $icon = isset($data['icon']) ? $data['icon'] : '';
    $hide = !(isset($data['hide']) ? ($data['hide'] == 1 ? true : false) : false);
    $activeRoute = isset($data['active_routes']) ? $data['active_routes'] : [];
    $accordion = !empty($menu['children']) ? '<span class="arrow"></span>' : '';
    $ret = [
        'label' => $menu['name'],
        'visible' => $hide,
        'url' => [$menu['route']],
        'items' => $menu['children'],
        'active_routes' => $activeRoute,
        'template' => '<li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1"><a href="{url}" class="m-menu__link"><i class="' . $icon . '"></i>' . $accordion . ' <span class="m-menu__link-text">{label}</span></a></li>',
        'icon' => $icon,
    ];
    return $ret;
};

$items = MenuHelper::getAssignedMenu(1, null, $callback);
$menus = Widget::generateMenu($items);

?>
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-aside-left  m-aside-left--skin-dark ">
            <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    <li class="m-menu__section m-menu__section--first">
                        <h4 class="m-menu__section-text">Main Menu</h4>
                        <i class="m-menu__section-icon flaticon-user"></i>
                    </li>
                    <?php if (1) {
    echo $menus;
} else {
    echo '<li class="m-menu__item m-menu__item--active" aria-haspopup="true"  m-menu-link-redirect="1" style="">
                                    <a  href="/simulator" class="m-menu__link ">
                                        <i class="m-menu__link-icon flaticon-share"></i>
                                        <span class="m-menu__link-text">Payment Simulator</span>
                                    </a>
                                </li>';
}?>
                </ul>
            </div>
        </div>