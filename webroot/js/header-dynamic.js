/**
 * Header Authentication Manager - Xservicios
 * Maneja autenticación dinámica, dropdown de usuario y estado de sesión
 */

(function() {
  'use strict';

  class HeaderAuthManager {
    constructor() {
      this.API_ME = '/xserv-usuarios/me';
      this.API_LOGOUT = '/logout';
      this.userData = null;
      this.isAuthenticated = false;

      this.loginBtn = document.getElementById('xservLoginBtn');
      this.userProfile = document.getElementById('xservUserProfile');
      this.userAvatar = document.getElementById('xservUserAvatar');
      this.userName = document.getElementById('xservUserName');
      this.logoutBtn = document.getElementById('xservLogoutBtn');

      this.init();
    }

    /**
     * Inicializa el manejador de autenticación
     */
    async init() {
      // Verificar estado de autenticación
      await this.checkAuth();

      // Configurar eventos
      this.setupEvents();

      // Cerrar dropdown al hacer clic fuera
      this.setupOutsideClick();
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
          const data = await response.json();
          if (data.usuario) {
            this.handleAuthSuccess(data.usuario);
            this.cacheUser(data.usuario);
          } else {
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
      // Actualizar avatar con iniciales
      if (this.userAvatar && user.nombre) {
        const initials = this.getInitials(user.nombre, user.apellido);
        this.userAvatar.textContent = initials;
      }

      // Actualizar nombre de usuario
      if (this.userName && user.nombre) {
        const fullName = user.apellido 
          ? `${user.nombre} ${user.apellido}` 
          : user.nombre;
        this.userName.textContent = fullName;
        this.userName.setAttribute('title', fullName);
      }
    }

    /**
     * Obtiene las iniciales del nombre
     */
    getInitials(nombre, apellido = '') {
      if (!nombre) return 'U';
      
      const firstInitial = nombre.charAt(0).toUpperCase();
      const lastInitial = apellido ? apellido.charAt(0).toUpperCase() : '';
      
      return `${firstInitial}${lastInitial}`;
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
     * Realiza logout
     */
    async logout() {
      try {
        // Mostrar indicador de carga (opcional)
        this.showLoadingState();

        // Llamar al endpoint de logout
        const response = await fetch(this.API_LOGOUT, {
          method: 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          },
          credentials: 'same-origin'
        });

        // Limpiar datos locales independientemente de la respuesta
        this.clearCachedUser();
        this.handleAuthFailure();

        // Redirigir a home o login
        setTimeout(() => {
          window.location.href = '/home';
        }, 100);

      } catch (error) {
        console.error('Error during logout:', error);
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
