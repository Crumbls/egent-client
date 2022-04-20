<?php

namespace Egent\Client\Menus;

use App\Models\User;
use App\Helpers\Menu;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Html;

class ClientMenu {
    public static function single(User $entity, User $user) {
        $menu = Menu::new();
        $menu->setWrapperTag('div');
        $menu->addClass('flex items-center justify-center mb-3');

        if (\Route::has('clients.update')) {
            /**
             * Edit
             */
            $menu->add(
                Link::toUrl(route( 'clients.edit', ['client' => $entity]),
                '<i class="mdi mdi-pencil-outline"></i><span class="sr-only">Edit</span>'
                )
                ->addClass('inline-block px-6 py-2.5 bg-yellow-400 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out')
            );
        }
		if (\Route::has('clients.show')) {
            /**
             * View
             */
            $menu->add(
                Link::toUrl(route('clients.show', ['client' => $entity]),
                    '<i class="mdi mdi-eye"></i><span class="sr-only">View</span>'
                )
                    ->addClass('inline-block px-6 py-2.5 bg-yellow-400 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out')

            );
        }

        /**
         * Delete
         */
        if (\Route::has('clients.delete')) {
            $menu->add(
                Link::toUrl(route('clients.delete', $entity),
                    '<i class="mdi mdi-delete" data-name="mdi-delete"></i></i><span class="sr-only">Delete</span>'
                )
                    ->addClass('inline-block px-6 py-2.5 bg-red-400 text-white font-medium text-xs leading-tight uppercase hover:bg-yellow-600 focus:bg-red-600 focus:outline-none focus:ring-0 active:bg-yellow-700 transition duration-150 ease-in-out')
            );
        }

        $menu->withoutParentTag();

        $items = $menu->getItems();
        if (array_key_exists(0, $items)) {
            $items[0]->addClass('rounded-l');
        }
        $x = count($items);
        if ($x) {
            $items[$x-1]->addClass('rounded-r');
        }

        return $menu->render();
    }
}