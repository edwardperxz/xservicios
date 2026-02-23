/**
 * i18n Preload Script
 * Aplica el idioma guardado ANTES de que se renderice la página
 * para evitar el "flash" de contenido sin traducir
 */
(function() {
  'use strict';
  
  // Leer idioma guardado
  const savedLang = localStorage.getItem('preferredLanguage') || 'es';
  console.log(`🚀 i18n-preload: Idioma detectado: ${savedLang}`);
  
  // Aplicar atributo lang al HTML inmediatamente
  document.documentElement.setAttribute('lang', savedLang);
  
  // Ocultar temporalmente el body para evitar flash
  const style = document.createElement('style');
  style.id = 'i18n-preload-style';
  style.textContent = `
    body {
      opacity: 0;
      transition: opacity 0.15s ease-in;
    }
    body.i18n-ready {
      opacity: 1;
    }
  `;
  document.head.appendChild(style);
  
  // Guardar el idioma en el objeto window para acceso rápido
  window.__i18nPreloadLang = savedLang;
  
  // Auto-mostrar después de un timeout como fallback de seguridad
  setTimeout(function() {
    if (document.body && !document.body.classList.contains('i18n-ready')) {
      document.body.classList.add('i18n-ready');
      console.warn('⚠️  i18n timeout - mostrando contenido (fallback de seguridad)');
    }
  }, 800);
})();
