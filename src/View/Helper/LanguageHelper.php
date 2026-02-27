<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\I18n\I18n;

/**
 * Helper para gestión de idiomas
 */
class LanguageHelper extends Helper
{
    /**
     * Obtiene el idioma actual
     *
     * @return string
     */
    public function getCurrentLocale(): string
    {
        return I18n::getLocale();
    }
    
    /**
     * Verifica si el idioma actual es español
     *
     * @return bool
     */
    public function isSpanish(): bool
    {
        return $this->getCurrentLocale() === 'es';
    }
    
    /**
     * Verifica si el idioma actual es inglés
     *
     * @return bool
     */
    public function isEnglish(): bool
    {
        return $this->getCurrentLocale() === 'en';
    }
    
    /**
     * Genera el selector de idioma como HTML
     *
     * @return string
     */
    public function languageSelector(): string
    {
        $currentLocale = $this->getCurrentLocale();
        $currentUrl = $this->getView()->getRequest()->getRequestTarget();
        
        // Remover parámetro lang existente
        $currentUrl = preg_replace('/[?&]lang=(es|en)/', '', $currentUrl);
        $separator = str_contains($currentUrl, '?') ? '&' : '?';
        
        $html = '<div class="language-selector">';
        
        // Botón Español
        if ($currentLocale === 'es') {
            $html .= '<button class="lang-btn active">ES</button>';
        } else {
            $html .= '<a href="' . $currentUrl . $separator . 'lang=es" class="lang-btn">ES</a>';
        }
        
        // Separador
        $html .= '<span class="lang-separator">|</span>';
        
        // Botón Inglés
        if ($currentLocale === 'en') {
            $html .= '<button class="lang-btn active">EN</button>';
        } else {
            $html .= '<a href="' . $currentUrl . $separator . 'lang=en" class="lang-btn">EN</a>';
        }
        
        $html .= '</div>';
        
        // CSS
        $html .= '
        <style>
            .language-selector {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: rgba(255, 255, 255, 0.05);
                padding: 0.5rem 0.75rem;
                border-radius: 8px;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .lang-btn {
                background: transparent;
                border: none;
                color: #a0a0a0;
                cursor: pointer;
                font-size: 0.875rem;
                font-weight: 500;
                padding: 0.25rem 0.5rem;
                border-radius: 4px;
                text-decoration: none;
                transition: all 0.2s;
            }
            .lang-btn:hover {
                background: rgba(201, 169, 98, 0.2);
                color: #c9a962;
            }
            .lang-btn.active {
                background: rgba(201, 169, 98, 0.3);
                color: #c9a962;
                cursor: default;
            }
            .lang-separator {
                color: rgba(255, 255, 255, 0.2);
                font-size: 0.875rem;
            }
        </style>
        ';
        
        return $html;
    }
}
