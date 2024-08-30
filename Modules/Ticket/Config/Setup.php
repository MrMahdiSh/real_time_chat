<?php

namespace Modules\Ticket\Config;


use Modules\Ticket\Entities\Ticket;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Ticket',
            'en_plural_name' => 'Ticket',
            'fa_name' => 'ارتباط با پزشکان',
            'fa_plural_name' => 'ارتباط با پزشکان',
            'prefix' => 'Ticket',
            'icon' => 'icon-disc',
            'menus' => [
                'Ticket.index' => ['label' => 'لیست گفت و گو', 'permission' => 'Ticket.index', 'icon' => ''],
            ],
            'permissions' => [
                'Ticket' => [
                    'label' => 'ارتباط با پزشکان',
                    'perms' => ['create', 'edit', 'index', 'destroy']
                ]
            ]
        ];
    }

    public function customSetup()
    {

    }

    public function customRemove()
    {
        (new Ticket())->delete();
    }
}
