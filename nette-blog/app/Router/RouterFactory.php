<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
    {
        $router = new RouteList;

        // Přidání routy pro presenter Adminer
        $router->addRoute('adminer[/<action>]', 'Adminer:default');

        // Přidání routy pro presenter Login s akcí in
        $router->addRoute('<presenter>/<action>[/<id>]', 'Login:in');

        // Přidání routy pro presenter Home s výchozí akcí default
        $router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');

        // Přidání routy pro akci sortData v presenteru Home
        $router->addRoute('<presenter>/sortData', 'Home:sortData');

        return $router;
    }
}
