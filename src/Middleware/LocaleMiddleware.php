<?php
declare(strict_types=1);

namespace App\Middleware;

use Cake\Http\Cookie\Cookie;
use Cake\Http\ServerRequest;
use Cake\I18n\I18n;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Middleware para detectar y configurar el idioma automáticamente
 * Prioridad: 
 * 1. Query string (?lang=en)
 * 2. Cookie
 * 3. Header Accept-Language
 * 4. Default (es)
 */
class LocaleMiddleware implements MiddlewareInterface
{
    /**
     * Procesa la solicitud para configurar el locale
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The handler.
     * @return \Psr\Http\Message\ResponseInterface The response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $locale = 'es'; // Default español
        
        // 1. Verificar query string (?lang=en)
        if ($request instanceof ServerRequest) {
            $queryLang = $request->getQuery('lang');
            if ($queryLang && in_array($queryLang, ['es', 'en'])) {
                $locale = $queryLang;
            }
            // 2. Verificar cookie
            elseif ($cookieLang = $request->getCookie('locale')) {
                if (in_array($cookieLang, ['es', 'en'])) {
                    $locale = $cookieLang;
                }
            }
            // 3. Verificar header Accept-Language
            else {
                $acceptLang = $request->getHeaderLine('Accept-Language');
                if (str_contains($acceptLang, 'en')) {
                    $locale = 'en';
                }
            }
        }
        
        // Configurar locale en CakePHP
        I18n::setLocale($locale);
        
        // Continuar con la solicitud
        $response = $handler->handle($request);
        
        // Guardar locale en cookie para siguiente visita (30 días)
        if ($locale !== 'es') {
            $cookie = new Cookie(
                'locale',
                $locale,
                new \DateTime('+30 days'),
                '/',
                null,
                false, // secure
                false, // httpOnly
                null
            );
            
            $response = $response->withAddedHeader('Set-Cookie', $cookie->toHeaderValue());
        }
        
        return $response;
    }
}
