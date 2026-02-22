/**
 * Header Authentication Manager - Xservicios
 * Maneja autenticación dinámica, dropdown de usuario y estado de sesión
 */

(function() {
  'use strict';

  class HeaderAuthManager {
    constructor() {
      this.API_ME = '/xserv-usuarios/me';
      this.API_LOGOUT = '/xserv-usuarios/logout';
      this.userData = null;
      this.isAuthenticated = false;
      this.maxRetries = 20;
      this.retryDelay = 100;
      this.initialized = false;

      this.initializeElements();
    }

    /**
     * Inicializa los elementos del DOM, esperando si es necesario
     */
    async initializeElements() {
      // Primero intentar inmediatamente
      if (this.findElements()) {
        await this.init();
        return;
      }

      // Si no están disponibles, esperar al evento headerLoaded
      const headerLoadedHandler = async () => {
        if (this.findElements()) {
          await this.init();
          document.removeEventListener('headerLoaded', headerLoadedHandler);
        }
      };
      
      document.addEventListener('headerLoaded', headerLoadedHandler);

      // Fallback: si después de 3 segundos no se dispara el evento, intentar con polling
      setTimeout(async () => {
        if (this.initialized) return;
        
        let retries = 0;
        while (retries < this.maxRetries && !this.initialized) {
          if (this.findElements()) {
            await this.init();
            document.removeEventListener('headerLoaded', headerLoadedHandler);
            return;
          }
          await new Promise(resolve => setTimeout(resolve, this.retryDelay));
          retries++;
        }

        if (!this.initialized) {
          console.warn('⚠️ Header elements not found after maximum retries. Auth functionality disabled.');
        }
      }, 3000);
    }

    /**
     * Busca los elementos del header en el DOM
     * @returns {boolean} true si encontró los elementos necesarios
     */
    findElements() {
      this.loginBtn = document.getElementById('xservLoginBtn');
      this.userProfile = document.getElementById('xservUserProfile');
      this.userAvatar = document.getElementById('xservUserAvatar');
      this.userName = document.getElementById('xservUserName');
      this.logoutBtn = document.getElementById('xservLogoutBtn');

      // Si encontramos al menos el botón de login O el perfil de usuario, podemos continuar
      return !!(this.loginBtn || this.userProfile);
    }

    /**
     * Inicializa el manejador de autenticación
     */
    async init() {
      if (this.initialized) return;
      
      this.initialized = true;
      console.log('🔐 Inicializando HeaderAuthManager...');
      
      // Verificar estado de autenticación
      await this.checkAuth();

      // Configurar eventos
      this.setupEvents();

      // Cerrar dropdown al hacer clic fuera
      this.setupOutsideClick();
      
      console.log('✅ HeaderAuthManager inicializado correctamente');
    }

    /**
     * Verifica el estado de autenticación del usuario
     */
    async checkAuth() {
      try {
        // Primero intentar obtener usuario del localStorage (cache)
        const cachedUser = this.getCachedUser();
        if (cachedUser) {
          this.handleAuthSuccess(cachedUser);
        }

        // Luego verificar con el servidor
        const response = await fetch(this.API_ME, {
          method: 'GET',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });

        if (response.ok) {
          // Verificar que la respuesta sea JSON
          const contentType = response.headers.get('content-type');
          if (contentType && contentType.includes('application/json')) {
            const data = await response.json();
            // El endpoint devuelve { success: true, user: {...} }
            if (data.success && data.user) {
              this.handleAuthSuccess(data.user);
              this.cacheUser(data.user);
            } else {
              this.handleAuthFailure();
            }
          } else {
            // Si no es JSON, probablemente no está autenticado
            this.handleAuthFailure();
          }
        } else {
          this.handleAuthFailure();
        }
      } catch (error) {
        console.warn('Error checking authentication:', error);
        this.handleAuthFailure();
      }
    }

    /**
     * Maneja autenticación exitosa
     */
    handleAuthSuccess(user) {
      this.isAuthenticated = true;
      this.userData = user;

      // Ocultar botón de login
      if (this.loginBtn) {
        this.loginBtn.classList.add('is-hidden');
      }

      // Mostrar perfil de usuario
      if (this.userProfile) {
        this.userProfile.classList.remove('is-hidden');
      }

      // Actualizar información del usuario
      this.updateUserInfo(user);
    }

    /**
     * Maneja fallo de autenticación
     */
    handleAuthFailure() {
      this.isAuthenticated = false;
      this.userData = null;

      // Mostrar botón de login
      if (this.loginBtn) {
        this.loginBtn.classList.remove('is-hidden');
      }

      // Ocultar perfil de usuario
      if (this.userProfile) {
        this.userProfile.classList.add('is-hidden');
      }

      // Limpiar cache
      this.clearCachedUser();
    }

    /**
     * Actualiza la información visual del usuario
     */
    updateUserInfo(user) {
      // Actualizar avatar con iniciales (usar nombre o username)
      if (this.userAvatar) {
        const displayName = user.nombre || user.username || 'US';
        const initials = this.getInitials(displayName);
        this.userAvatar.textContent = initials;
      }

      // Actualizar nombre de usuario
      if (this.userName) {
        const displayName = user.nombre || user.username || 'Usuario';
        this.userName.textContent = displayName;
        this.userName.setAttribute('title', displayName);
      }
    }

    /**
     * Obtiene las iniciales del nombre
     */
    getInitials(nombre, apellido = '') {
      if (!nombre) return 'US';
      
      // Si se proporcionó nombre y apellido por separado
      if (apellido) {
        const firstInitial = nombre.charAt(0).toUpperCase();
        const lastInitial = apellido.charAt(0).toUpperCase();
        return `${firstInitial}${lastInitial}`;
      }
      
      // Si es un nombre completo (puede tener espacios)
      const parts = nombre.trim().split(/\s+/);
      if (parts.length === 1) {
        // Solo un nombre, tomar las primeras 2 letras
        return parts[0].substring(0, 2).toUpperCase();
      } else {
        // Nombre y apellido(s), tomar primera letra de cada uno
        const firstInitial = parts[0].charAt(0).toUpperCase();
        const lastInitial = parts[parts.length - 1].charAt(0).toUpperCase();
        return `${firstInitial}${lastInitial}`;
      }
    }

    /**
     * Configura eventos del header
     */
    setupEvents() {
      // Toggle dropdown al hacer clic en el perfil
      if (this.userProfile) {
        this.userProfile.addEventListener('click', (e) => {
          e.stopPropagation();
          this.toggleDropdown();
        });
      }

      // Evento de logout
      if (this.logoutBtn) {
        this.logoutBtn.addEventListener('click', async (e) => {
          e.preventDefault();
          e.stopPropagation();
          await this.logout();
        });
      }

      // Prevenir que los enlaces del dropdown cierren el menú inmediatamente
      const dropdownMenu = document.querySelector('.xserv-dropdown-menu');
      if (dropdownMenu) {
        const links = dropdownMenu.querySelectorAll('a:not(#xservLogoutBtn)');
        links.forEach(link => {
          link.addEventListener('click', () => {
            this.closeDropdown();
          });
        });
      }
    }

    /**
     * Configura cierre de dropdown al hacer clic fuera
     */
    setupOutsideClick() {
      document.addEventListener('click', (e) => {
        if (this.userProfile && !this.userProfile.contains(e.target)) {
          this.closeDropdown();
        }
      });
    }

    /**
     * Toggle del dropdown de usuario
     */
    toggleDropdown() {
      if (this.userProfile) {
        this.userProfile.classList.toggle('open');
      }
    }

    /**
     * Cierra el dropdown
     */
    closeDropdown() {
      if (this.userProfile) {
        this.userProfile.classList.remove('open');
      }
    }

    /**
     * Obtiene el token CSRF de meta tag o cookies
     */
    getCsrfToken() {
      // Primero intentar obtener del meta tag (como header-auth.js)
      const meta = document.querySelector('meta[name="csrfToken"], meta[name="csrf-token"]');
      if (meta) {
        const token = meta.getAttribute('content');
        if (token) return token;
      }

      // Fallback: buscar en cookies
      const name = 'csrfToken=';
      const decodedCookie = decodeURIComponent(document.cookie);
      const cookies = decodedCookie.split(';');
      
      for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim();
        if (cookie.indexOf(name) === 0) {
          return cookie.substring(name.length, cookie.length);
        }
      }
      return null;
    }

    /**
     * Realiza logout
     */
    async logout() {
      try {
        console.log('🔐 Iniciando logout...');
        
        // Mostrar indicador de carga (opcional)
        this.showLoadingState();

        // Obtener token CSRF
        const csrfToken = this.getCsrfToken();
        console.log('🔑 CSRF Token obtenido:', csrfToken ? 'Sí' : 'No');

        // Llamar al endpoint de logout
        const headers = {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        };

        // Agregar token CSRF si existe
        if (csrfToken) {
          headers['X-CSRF-Token'] = csrfToken;
        }

        console.log('📤 Enviando petición a:', this.API_LOGOUT);
        
        const response = await fetch(this.API_LOGOUT, {
          method: 'POST',
          headers: headers,
          credentials: 'same-origin'
        });

        console.log('📥 Respuesta recibida:', response.status, response.ok ? 'OK' : 'ERROR');

        if (response.ok) {
          const data = await response.json();
          console.log('✅ Logout exitoso:', data);
        }

        // Limpiar datos locales independientemente de la respuesta
        this.clearCachedUser();
        this.handleAuthFailure();

        console.log('🔄 Redirigiendo a /home...');
        
        // Redirigir a home o login
        setTimeout(() => {
          window.location.href = '/home';
        }, 100);

      } catch (error) {
        console.error('❌ Error durante logout:', error);
        // Aún así limpiar sesión local
        this.clearCachedUser();
        this.handleAuthFailure();
        window.location.href = '/home';
      }
    }

    /**
     * Muestra estado de carga
     */
    showLoadingState() {
      if (this.logoutBtn) {
        const span = this.logoutBtn.querySelector('span');
        if (span) {
          span.setAttribute('data-original-text', span.textContent);
          span.textContent = 'Cerrando...';
        }
      }
    }

    /**
     * Cache de usuario en localStorage
     */
    cacheUser(user) {
      try {
        const cacheData = {
          user: user,
          timestamp: Date.now(),
          expiresIn: 3600000 // 1 hora
        };
        localStorage.setItem('xserv_user', JSON.stringify(cacheData));
      } catch (error) {
        console.warn('Error caching user:', error);
      }
    }

    /**
     * Obtiene usuario cacheado
     */
    getCachedUser() {
      try {
        const cached = localStorage.getItem('xserv_user');
        if (!cached) return null;

        const cacheData = JSON.parse(cached);
        const now = Date.now();

        // Verificar si no ha expirado
        if (now - cacheData.timestamp < cacheData.expiresIn) {
          return cacheData.user;
        }

        // Si expiró, limpiar
        this.clearCachedUser();
        return null;
      } catch (error) {
        console.warn('Error getting cached user:', error);
        return null;
      }
    }

    /**
     * Limpia usuario cacheado
     */
    clearCachedUser() {
      try {
        localStorage.removeItem('xserv_user');
      } catch (error) {
        console.warn('Error clearing cached user:', error);
      }
    }

    /**
     * Obtiene el usuario actual
     */
    getCurrentUser() {
      return this.userData;
    }

    /**
     * Verifica si está autenticado
     */
    isUserAuthenticated() {
      return this.isAuthenticated;
    }
  }

  // Inicializar cuando el DOM esté listo
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      window.headerAuthManager = new HeaderAuthManager();
    });
  } else {
    window.headerAuthManager = new HeaderAuthManager();
  }

  // Exponer funciones útiles globalmente
  window.checkHeaderAuth = () => {
    if (window.headerAuthManager) {
      return window.headerAuthManager.checkAuth();
    }
  };

  window.getHeaderUser = () => {
    if (window.headerAuthManager) {
      return window.headerAuthManager.getCurrentUser();
    }
    return null;
  };

  window.isHeaderAuthenticated = () => {
    if (window.headerAuthManager) {
      return window.headerAuthManager.isUserAuthenticated();
    }
    return false;
  };

})();
