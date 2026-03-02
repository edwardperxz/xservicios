<?php
declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BypassAuthorizationMiddleware implements MiddlewareInterface
{
    /**
     * Rutas que deben bypassear autorización
     */
    private array $skipRoutes = [
        '/xserv-reservas/quick-reserve',
    ];

    /**
     * Procesar la solicitud
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();
        
        // Si la ruta está en la whitelist, marcar para saltarse la autorización
        foreach ($this->skipRoutes as $route) {
            if (strpos($path, $route) === 0) {
                // Marcar la request para saltarse autorización
                $request = $request->withAttribute('skipAuthorization', true);
                break;
            }
        }
        
        return $handler->handle($request);
    }
}
