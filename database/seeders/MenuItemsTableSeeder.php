<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Facades\Voyager;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // first truncate
        \DB::table('menu_items')->delete();

        $admin_menu_id = 1;
        $reapp_menu_id = 2;
        $guest_menu_id = 3;

        /* 1. Metrics */
        /*   1.1 Dashboard */
        /*   1.2 Statistics (not yet implemented) */
        /* 2. Customers */
        /*   2.1 Accounts */
        /* 3. Data */
        /*   3.1 Categories */
        /*   3.2 Courses */
        /*   3.4 Media */
        /* 4. Communications */
        /*   4.1 Announcements */
        /*   4.2 Blog */
        /* 5. Tools */
        /*   5.1 Settings */
        /*   5.2 Themes */
        /*   5.3 Menu Builder */
        /*   5.4 Roles */
        /*   5.5 Database */
        /*   5.6 Compass */
        /*   5.7 BREAD */
        $spec_admin = [
            'Metrics' => ['menu_id' => $admin_menu_id, 'target' => '_self', 'icon_class' => 'voyager-dashboard', 'order' => 1, 'children' => [
                'Dashboard' => ['route' => 'wave.dashboard', 'target' => '_self', 'icon_class' => 'voyager-boat', 'order' => 1],
                //XXX 'Statistics' => [],
            ]],

            'Customers' => ['menu_id' => $admin_menu_id, 'target' => '_self', 'icon_class' => 'voyager-people', 'order' => 2, 'children' => [
                'Accounts' => ['route' => 'voyager.users.index', 'target' => '_self', 'icon_class' => 'voyager-person', 'order' => 1],
            ]],

            'Data' => ['menu_id' => $admin_menu_id, 'target' => '_self', 'icon_class' => 'voyager-upload', 'order' => 3, 'children' => [
                'Categories' => ['route' => 'voyager.categories.index', 'target' => '_self', 'icon_class' => 'voyager-list', 'order' => 1],
                'Courses' => ['route' => 'voyager.courses.index', 'target' => '_self', 'icon_class' => 'voyager-controller', 'order' => 2],
                'Media' => ['route' => 'voyager.media.index', 'target' => '_self', 'icon_class' => 'voyager-images', 'order' => 2],
            ]],

            'Communications' => ['menu_id' => $admin_menu_id, 'target' => '_self', 'icon_class' => 'voyager-mail', 'order' => 4, 'children' => [
                'Announcements' => ['route' => 'voyager.announcements.index', 'target' => '_self', 'icon_class' => 'voyager-bubble', 'order' => 1],
                'Posts' => ['route' => 'voyager.posts.index', 'target' => '_self', 'icon_class' => 'voyager-list-add', 'order' => 2],
                'Pages' => ['route' => 'voyager.pages.index', 'target' => '_self', 'icon_class' => 'voyager-file-text', 'order' => 3],
            ]],

            'Tools' => ['menu_id' => $admin_menu_id, 'target' => '_self', 'icon_class' => 'voyager-tools', 'order' => 5, 'children' => [
                'Settings' => ['route' => 'voyager.settings.index', 'target' => '_self', 'icon_class' => 'voyager-settings', 'order' => 1],
                'Themes' => ['url' => '/admin/themes', 'target' => '_self', 'icon_class' => 'voyager-settings', 'order' => 2],
                'Menu Builder' => ['route' => 'voyager.menus.index', 'target' => '_self', 'icon_class' => 'voyager-list', 'order' => 3],
                'Roles' => ['route' => 'voyager.roles.index', 'target' => '_self', 'icon_class' => 'voyager-lock', 'order' => 4],
                'Database' => ['route' => 'voyager.database.index', 'target' => '_self', 'icon_class' => 'voyager-data', 'order' => 5],
                'Compass' => ['route' => 'voyager.compass.index', 'target' => '_self', 'icon_class' => 'voyager-compass', 'order' => 6],
                'BREAD' => ['route' => 'voyager.bread.index', 'target' => '_self', 'icon_class' => 'voyager-bread', 'order' => 7],
            ]],
        ];

        /* 1. Library */
        /* 2. Courses */
        $spec_reapp = [
            'Library' => ['menu_id' => $reapp_menu_id, 'target' => '_self', 'icon_class' => 'home', 'url' => '', 'order' => 1, 'children' => [
                'Browse' => ['menu_id' => $reapp_menu_id, 'target' => '_self', 'icon_class' => 'voyager-logbook', 'order' => 1, 'route' => 'wave.dashboard'],
                'Latest' => ['menu_id' => $reapp_menu_id, 'target' => '_self', 'icon_class' => 'voyager-logbook', 'order' => 2, 'route' => 'reapp.feed'],
            ]],
        ];

        /* 1. Home */
        /* 2. Features */
        /* 3. Testimonials */
        /* 4. Pricing */
        /* 5. Blog */
        $spec_guest = [
            'Home' => ['menu_id' => $guest_menu_id, 'target' => '_self', 'icon_class' => null, 'url' => '', 'order' => 1],
            'Features' => ['menu_id' => $guest_menu_id, 'target' => '_self', 'icon_class' => null, 'url' => '/#features', 'order' => 2],
            'Testimonials' => ['menu_id' => $guest_menu_id, 'target' => '_self', 'icon_class' => null, 'url' => '/#testimonials', 'order' => 3],
            'Pricing' => ['menu_id' => $guest_menu_id, 'target' => '_self', 'icon_class' => null, 'url' => '/#pricing', 'order' => 4],
            'Blog' => ['menu_id' => $guest_menu_id, 'target' => '_self', 'icon_class' => null, 'route' => 'wave.blog', 'order' => 5],
        ];

        $this->createMenuItems($spec_admin);
        $this->createMenuItems($spec_reapp);
        $this->createMenuItems($spec_guest);
    }

    protected function createMenuItems(array $spec) {

        // create menu items from spec
        foreach ($spec as $title => $main_menu_config):
            $main_menu_config['url'] = '';

            // create main menu entry
            $main = Voyager::model('MenuItem')->updateOrCreate(
                ['title' => $title, 'menu_id' => $main_menu_config['menu_id']],
                \Arr::except($main_menu_config, ['title', 'menu_id', 'children'])
            );

            // create children
            foreach (($main_menu_config['children'] ?? []) as $subtitle => $sub_menu_config):
                $sub_menu_config['url'] = '';
                $sub = Voyager::model('MenuItem')->updateOrCreate(
                    ['title' => $subtitle, 'menu_id' => $main_menu_config['menu_id'], 'parent_id' => $main->id],
                    \Arr::except($sub_menu_config, ['title', 'menu_id'])
                );
            endforeach;
        endforeach;
    }
}
