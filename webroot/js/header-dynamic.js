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
      // Elementos desktop
      this.loginBtn = document.getElementById('xservLoginBtn');
      this.userProfileWrapper = document.getElementById('xservUserProfileWrapper');
      this.userProfileBtn = document.getElementById('xservUserProfile');
      this.logoutBtn = document.getElementById('xservLogoutBtn');
      this.userAvatar = document.getElementById('xservUserAvatar');
      this.userName = document.getElementById('xservUserName');
      this.navMyReservations = document.getElementById('xservNavMyReservations');
      this.navMyReservationsMobile = document.getElementById('xservNavMyReservationsMobile');

      // Elementos mobile
      this.loginBtnMobile = document.getElementById('xservLoginBtnMobile');
      this.userProfileMobile = document.getElementById('xservUserProfileMobile');
      this.userAvatarMobile = document.getElementById('xservUserAvatarMobile');
      this.userNameMobile = document.getElementById('xservUserNameMobile');
      this.logoutBtnMobile = document.getElementById('xservLogoutBtnMobile');

      // Si encontramos al menos el botón de login O el perfil de usuario, podemos continuar
      return !!(this.loginBtn || this.userProfileWrapper || this.loginBtnMobile || this.userProfileMobile);
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

      // Ocultar botón de login desktop
      if (this.loginBtn) {
        this.loginBtn.classList.add('is-hidden');
      }

      // Mostrar perfil de usuario desktop
      if (this.userProfileWrapper) {
        this.userProfileWrapper.classList.remove('is-hidden');
      }

      // Ocultar botón de login mobile
      if (this.loginBtnMobile) {
        this.loginBtnMobile.classList.add('is-hidden');
      }

      // Mostrar perfil de usuario mobile
      if (this.userProfileMobile) {
        this.userProfileMobile.classList.remove('is-hidden');
      }

      // Mostrar "Mis Reservas" en navegación desktop
      if (this.navMyReservations) {
        this.navMyReservations.classList.remove('is-hidden');
      }

      // Mostrar "Mis Reservas" en navegación mobile
      if (this.navMyReservationsMobile) {
        this.navMyReservationsMobile.classList.remove('is-hidden');
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

      // Mostrar botón de login desktop
      if (this.loginBtn) {
        this.loginBtn.classList.remove('is-hidden');
      }

      // Ocultar perfil de usuario desktop
      if (this.userProfileWrapper) {
        this.userProfileWrapper.classList.add('is-hidden');
      }

      // Mostrar botón de login mobile
      if (this.loginBtnMobile) {
        this.loginBtnMobile.classList.remove('is-hidden');
      }

      // Ocultar perfil de usuario mobile
      if (this.userProfileMobile) {
        this.userProfileMobile.classList.add('is-hidden');
      }

      // Ocultar "Mis Reservas" en navegación desktop
      if (this.navMyReservations) {
        this.navMyReservations.classList.add('is-hidden');
      }

      // Ocultar "Mis Reservas" en navegación mobile
      if (this.navMyReservationsMobile) {
        this.navMyReservationsMobile.classList.add('is-hidden');
      }

      // Limpiar cache
      this.clearCachedUser();
    }

    /**
     * Actualiza la información visual del usuario
     */
    updateUserInfo(user) {
      const displayName = user.nombre || user.username || 'Usuario';
      const initials = this.getInitials(displayName);

      // Actualizar avatar desktop
      if (this.userAvatar) {
        this.userAvatar.textContent = initials;
      }

      // Actualizar nombre desktop
      if (this.userName) {
        this.userName.textContent = displayName;
        this.userName.setAttribute('title', displayName);
      }

      // Actualizar avatar mobile
      if (this.userAvatarMobile) {
        this.userAvatarMobile.textContent = initials;
      }

      // Actualizar nombre mobile
      if (this.userNameMobile) {
        this.userNameMobile.textContent = displayName;
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
      // Elementos
      const menuToggle = document.getElementById('menuToggle');
      const navSidebar = document.getElementById('navSidebar');
      const sidebarOverlay = document.getElementById('sidebarOverlay');
      const navItems = document.querySelectorAll('.xserv-nav-item-mobile');

      // Funciones auxiliares
      const toggleSidebar = () => {
        navSidebar?.classList.toggle('open');
        sidebarOverlay?.classList.toggle('active');
        document.body.style.overflow = navSidebar?.classList.contains('open') ? 'hidden' : '';
      };

      const closeSidebar = () => {
        navSidebar?.classList.remove('open');
        sidebarOverlay?.classList.remove('active');
        document.body.style.overflow = '';
      };

      // Toggle al hacer clic en hamburguesa
      menuToggle?.addEventListener('click', toggleSidebar);

      // Cerrar al hacer clic en overlay
      sidebarOverlay?.addEventListener('click', closeSidebar);

      // Cerrar al navegar
      navItems.forEach(item => {
        item.addEventListener('click', () => {
          if (window.innerWidth <= 1115) {
            closeSidebar();
          }
        });
      });

      // Nota: El botón de idioma en mobile es manejado por i18n.js
      // que cierra el sidebar después de cambiar el idioma

      // Cerrar botón de login en mobile
      const loginBtnMobile = document.getElementById('xservLoginBtnMobile');
      loginBtnMobile?.addEventListener('click', (e) => {
        e.stopPropagation();
        setTimeout(closeSidebar, 100);
      });

      // Cerrar al hacer clic en el botón de cierre del sidebar
      const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
      sidebarCloseBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        closeSidebar();
      });

      // Cerrar en resize
      window.addEventListener('resize', () => {
        if (window.innerWidth > 1115) {
          closeSidebar();
        }
      });

      // Prevenir scroll en sidebar
      navSidebar?.addEventListener('touchmove', (e) => {
        if (navSidebar?.classList.contains('open')) {
          e.stopPropagation();
        }
      }, { passive: true });

      // Logout mobile
      if (this.logoutBtnMobile) {
        this.logoutBtnMobile.addEventListener('click', async (e) => {
          e.preventDefault();
          e.stopPropagation();
          closeSidebar();
          await this.logout();
        });
      }

      // Enlaces del menú de usuario mobile
      const userMenuMobile = document.querySelectorAll('.xserv-user-menu-item:not(#xservLogoutBtnMobile)');
      userMenuMobile?.forEach(link => {
        link.addEventListener('click', () => {
          closeSidebar();
        });
      });

      // Botón de notificaciones
      const notificationBtn = document.getElementById('xservNotificationBtn');
      notificationBtn?.addEventListener('click', () => {
        window.location.href = '/notifications';
      });

      // Dropdown de perfil en desktop
      if (this.userProfileBtn && this.userProfileWrapper) {
        this.userProfileBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          this.userProfileWrapper.classList.toggle('open');
        });
      }

      // Logout en desktop
      if (this.logoutBtn) {
        this.logoutBtn.addEventListener('click', async (e) => {
          e.preventDefault();
          e.stopPropagation();
          if (this.userProfileWrapper) {
            this.userProfileWrapper.classList.remove('open');
          }
          await this.logout();
        });
      }
    }

    /**
     * Configura cierre de dropdown al hacer clic fuera
     */
    setupOutsideClick() {
      document.addEventListener('click', (e) => {
        // Cerrar menú mobile
        const navSidebar = document.getElementById('navSidebar');
        const menuToggle = document.getElementById('menuToggle');

        if (navSidebar && menuToggle) {
          if (!menuToggle.contains(e.target) && !navSidebar.contains(e.target)) {
            navSidebar.classList.remove('open');
            document.getElementById('sidebarOverlay')?.classList.remove('active');
            document.body.style.overflow = '';
          }
        }

        // Cerrar dropdown de perfil en desktop
        if (this.userProfileWrapper && this.userProfileBtn) {
          if (!this.userProfileWrapper.contains(e.target)) {
            this.userProfileWrapper.classList.remove('open');
          }
        }
      });
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
      // No hay cambios visuales necesarios en el estado de carga
      // El logout sucede rápidamente en mobile
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
