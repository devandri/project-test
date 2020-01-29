<?php

namespace app\components;
use Yii;

class Widget
{
	public function generateMenu($items) {
		$html = '';
		if (is_array($items) and !empty($items)) {
			// Loop menu level 1
			foreach ($items as $key => $item) {
				// $html .= '$items[$i]'
				$label 		= isset($item['label']) ? $item['label'] : '';
				$visible 	= isset($item['visible']) ? $item['visible'] : '';
				$no_disp 	= empty($visible) ? "display:none" : "";
				$url 		= isset($item['url']) ? $item['url'] : '';
				$childs 	= isset($item['items']) ? $item['items'] : '';
				$template 	= isset($item['template']) ? $item['template'] : '';
				$icon 		= isset($item['icon']) ? $item['icon'] : '';
				if (empty($childs)) {
					$html .= '
					<li class="m-menu__item '.self::activeClass($item).'" aria-haspopup="true"  m-menu-link-redirect="1" style="'.$no_disp.'">
					    <a  href="'.$url[0].'" class="m-menu__link ">
					        <i class="m-menu__link-icon '.$icon.'"></i>
					        <span class="m-menu__link-text">'.$label.'</span>
					    </a>
					</li>
					';
				} else {
					$html .= '
					<li class="m-menu__item  m-menu__item--submenu '.self::parentClass($item).'" aria-haspopup="true"  m-menu-submenu-toggle="hover">
					    <a  href="javascript:;" class="m-menu__link m-menu__toggle">
					        <i class="m-menu__link-icon '.$icon.'"></i>
					        <span class="m-menu__link-text">'.$label.'</span>
					        <i class="m-menu__ver-arrow la la-angle-right"></i>
					    </a>
					    <div class="m-menu__submenu ">
					        <span class="m-menu__arrow"></span>
					        <ul class="m-menu__subnav">
					';
					// Loop menu level 2
					foreach ($childs as $key => $value) {
						$label_child 	= isset($value['label']) ? $value['label'] : '';
						$visible_child 	= isset($value['visible']) ? $value['visible'] : '';
						$no_disp_child 	= empty($visible_child) ? "display:none" : "";
						$url_child 		= isset($value['url'][0]) ? $value['url'][0] : '';
						$icon_child 	= isset($value['icon']) ? $value['icon'] : '';
						if (!empty($icon_child))
							$icon_element = '<i class="m-menu__link-icon '.$icon_child.'"></i>';
						else
							$icon_element = '<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>';
						// $url_child = '';
						$html .= '
						<li class="m-menu__item '.self::activeClass($value).'" aria-haspopup="true"  m-menu-link-redirect="1" style="'.$no_disp_child.'">
						    <a  href="'.$url_child.'" class="m-menu__link ">
						        '.$icon_element.'
						        <span class="m-menu__link-text">'.$label_child.'</span>
						    </a>
						</li>
						';
					}
					$html .= '
							</ul>
					    </div>
					</li>
					';
				}
			}
		}
		return $html;
	}

	public static function activeClass($item) {
	    $currentRoute = '/'.Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
	    if ($currentRoute == $item['url'][0] or (!empty($item['active_routes']) && in_array($currentRoute, $item['active_routes']) ) ){
	    	return 'm-menu__item--active';
	    } else {
	    	return '';
	    }
	}

	public static function parentClass($item){
		$arr 	= array_column($item['items'], 'url');
	    $search = (string)array_search('/'.Yii::$app->controller->id.'/'.Yii::$app->controller->action->id, array_column($arr, 0));
	    if ($search != '')
	        return 'm-menu__item--open m-menu__item--expanded';
	    else 
	        return '';
	}
}