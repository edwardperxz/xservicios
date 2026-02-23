/**
 * Script auxiliar para manejar placeholders traducibles
 * Este script se asegura de que los placeholders se traduzcan correctamente
 */

document.addEventListener('DOMContentLoaded', () => {
  // Traducir placeholders con data-i18n-placeholder
  const updatePlaceholders = () => {
    const elementsWithPlaceholders = document.querySelectorAll('[data-i18n-placeholder]');
    
    elementsWithPlaceholders.forEach(element => {
      const key = element.getAttribute('data-i18n-placeholder');
      const currentLang = localStorage.getItem('preferredLanguage') || 'es';
      
      if (window.translations && window.translations[currentLang] && window.translations[currentLang][key]) {
        element.placeholder = window.translations[currentLang][key];
      }
    });
  };

  // Ejecutar al cargar
  updatePlace, window, window.I18n || {});
  
  // Escuchar cambios de idioma
  window.addEventListener('languageChanged', updatePlaceholders);
});
