<?php namespace Vhiweb\Api;

use Backend;
use System\Classes\PluginBase;

/**
 * Api Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Api',
            'description' => 'No description provided yet...',
            'author'      => 'Vhiweb',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Vhiweb\Api\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'vhiweb.api.some_permission' => [
                'tab' => 'Api',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'api' => [
                'label'       => 'Api',
                'url'         => Backend::url('vhiweb/api/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['vhiweb.api.*'],
                'order'       => 500,
            ],
        ];
    }
}
