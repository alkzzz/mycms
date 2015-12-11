<?php

namespace cms\Http\Middleware;

use Closure;
use Localization;
use MainMenu;
use cms\Post;

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
        $mainmenu->add(trans('route.home'), route('homepage'));
        foreach ($daftarmenu as $menu) {
            if ($locale == 'id') {
                $submenu = $mainmenu->add($menu->title_id, 'id'.'/'.$menu->slug_id);
                if ($menu->has_child) {
                    foreach ($daftarsubmenu as $sub) {
                        if ($sub->post_parent == $menu->id) {
                        $submenu->add($sub->title_id, 'id'.'/'.$sub->slug_id);
                        }
                    }
                }
            }
            else
            {
               $submenu = $mainmenu->add($menu->title_en, 'en'.'/'.$menu->slug_en);
                if ($menu->has_child) {
                    foreach ($daftarsubmenu as $sub) {
                        if ($sub->post_parent == $menu->id) {
                          $submenu->add($sub->title_en, 'en'.'/'.$sub->slug_en);
                        }
                    }
                }
            }
        }

    });

        return $next($request);
    }
}
