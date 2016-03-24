<?php

namespace cms\Http\Middleware;

use Closure;
use Localization;
use MainMenu;
use cms\Post;
use cms\TopMenu;

class GenerateMenu
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

    MainMenu::make('mainmenu', function($mainmenu) {
        $locale = Localization::getCurrentLocale();
        $daftarmenu = Post::page()->menu()->get()->sortBy('urutan');
        $daftarsubmenu = Post::page()->submenu()->get()->sortBy('urutan');
        $mainmenu->add(trans('trans.home'), route('homepage'));
        foreach ($daftarmenu as $menu) {
            if ($locale == 'id') {
                if ($menu->link_id) {
                $submenu = $mainmenu->add($menu->title_id, $menu->link_id);
                }
                else {
                $submenu = $mainmenu->add($menu->title_id, 'id'.'/'.$menu->slug_id);
                }
                if ($menu->has_child) {
                    foreach ($daftarsubmenu as $sub) {
                        if ($sub->post_parent == $menu->id) {
                          if ($sub->link_id) {
                            $submenu->add($sub->title_id, $sub->link_id);
                          }
                          else {
                            $submenu->add($sub->title_id, 'id'.'/'.$sub->slug_id);
                          }
                        }
                    }
                }
            }
            else
            {
              if ($menu->link_en) {
              $submenu = $mainmenu->add($menu->title_en, $menu->link_en);
              }
              else {
              $submenu = $mainmenu->add($menu->title_en, 'en'.'/'.$menu->slug_en);
              }
                if ($menu->has_child) {
                    foreach ($daftarsubmenu as $sub) {
                        if ($sub->post_parent == $menu->id) {
                          if ($sub->link_en) {
                            $submenu->add($sub->title_en, $sub->link_en);
                          }
                          else {
                            $submenu->add($sub->title_en, 'en'.'/'.$sub->slug_en);
                          }
                        }
                    }
                }
            }
        }

    });
        return $next($request);
    }
}
