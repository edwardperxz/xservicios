/**
 * Sistema de internacionalización (i18n) para Xservicios
 * Maneja la traducción de contenido entre español e inglés
 */

const translations = {
  es: {
    // Navegación
    'nav.home': 'Inicio',
    'nav.fleet': 'Ver flota',
    'nav.services': 'Servicios',
    'nav.about': 'Nosotros',
    
    // Autenticación
    'auth.login': 'Iniciar sesión',
    'auth.user': 'Usuario',
    'auth.signUp': 'Crear cuenta',
    'auth.rememberMe': 'Recordarme',
    'auth.forgotPassword': '¿Olvidaste tu contraseña?',
    'auth.loginTitle': 'Inicia Sesión',
    'auth.loginSubtitle': 'Inicia sesión en cualquiera de tus cuentas existentes',
    'auth.signUpTitle': 'Crea una cuenta',
    'auth.signUpSubtitle': 'Regístrate para continuar',
    'auth.username': 'Nombre de Usuario',
    'auth.noAccount': '¿No tienes una cuenta?',
    'auth.haveAccount': '¿Ya tienes cuenta?',
    
    // Perfil de usuario
    'profile.myProfile': 'Mi Perfil',
    'profile.myReservations': 'Mis Reservas',
    'profile.settings': 'Configuración',
    'profile.logout': 'Cerrar Sesión',
    
    // Hero Section - Nosotros
    'hero.titlePart1': 'Transporte Turístico',
    'hero.titlePart2': 'de Lujo',
    'hero.bookNow': 'Reservar Ahora',
    
    // Hero Section - Home Public
    'homeHero.title': 'VISITA<br><span>BOCAS DEL TORO</span>',
    'homeHero.desc1': '<strong>Experiencia única.</strong> Descubre destinos increíbles con el mejor servicio de transporte turístico.',
    'homeHero.desc2': '<strong>Confort garantizado.</strong> Viaja con seguridad y estilo en nuestros vehículos de lujo.',
    'homeHero.desc3': '<strong>Guías expertos.</strong> Personal capacitado para hacer tu experiencia inolvidable.',
    
    // Hero Section - Home Login
    'homeLogin.heroTitle': 'Transporte turístico de lujo en Chiriquí',
    'homeLogin.heroDesc': 'Reserva un traslado seguro, puntual y de alta calidad con Xservicios.',
    'homeLogin.newReservation': 'Nueva Reserva',
    'homeLogin.quickSummary': 'Resumen Rápido',
    'homeLogin.myReservations': 'Mis Reservas',
    'homeLogin.rateService': 'Valorar Servicio',
    'homeLogin.serviceHistory': 'Historial de Servicios',
    'homeLogin.seeMore': 'Ver Más',
    
    // About Section
    'about.title': 'Quiénes Somos',
    'about.description': 'En Xservicios somos un sistema de transporte turístico de lujo enfocado en ofrecer traslados seguros, eficientes y de alta calidad. Nuestra operación está diseñada para atender a clientes que valoran el confort, la puntualidad y un servicio confiable, brindando una experiencia de movilidad alineada con estándares premium en cada recorrido.',
    'about.button': 'Conoce Nuestra Historia',
    
    // Gallery Section
    'gallery.title': 'Nuestros Destinos',
    'gallery.subtitle': 'Descubre los lugares más hermosos de Chiriquí con nosotros',
    
    // Fleet Section
    'fleet.title': 'Acerca de Nuestra Flota',
    'fleet.description': 'Nuestra flota está compuesta por unidades modernas y cuidadosamente mantenidas, pensadas para garantizar comodidad y seguridad en todo momento. Contamos con dos buses tipo Coaster y dos buses con capacidad para 15 pasajeros, lo que nos permite atender traslados turísticos y corporativos con eficiencia, adaptándonos a diferentes necesidades sin comprometer la calidad del servicio.',
    'fleet.viewDetails': 'Ver Detalles',
    'fleet.capacity': 'Capacidad',
    'fleet.passengers': 'pasajeros',
    'fleet.available': 'Disponible',
    
    // Team Section
    'team.title': 'Nuestros Colaboradores',
    'team.description': 'Nuestros choferes son profesionales responsables, transparentes y comprometidos con su labor. Cada colaborador representa los valores de Xservicios, destacándose por su puntualidad, trato respetuoso y enfoque en la seguridad, asegurando que cada traslado se realice con el profesionalismo y la confianza que nuestros clientes esperan.',
    'team.button': 'Conocer al Equipo',
    
    // Features Section
    'features.premium': 'Servicio Premium',
    'features.satisfied': 'Clientes Satisfechos',
    'features.punctual': 'Siempre Puntuales',
    'features.quality': 'Alta Calidad',
    
    // Services Section
    'services.title': 'Nuestros Servicios',
    'services.subtitle': 'Servicios de transporte turístico de lujo',
    'services.from': 'Desde',
    'services.bookNow': 'Reservar',
    
    // Reservations
    'reservations.title': 'Mis Reservas',
    'reservations.new': 'Nueva Reserva',
    'reservations.status': 'Estado',
    'reservations.pending': 'Pendiente',
    'reservations.confirmed': 'Confirmada',
    'reservations.completed': 'Completada',
    'reservations.cancelled': 'Cancelada',
    'reservations.date': 'Fecha',
    'reservations.time': 'Hora',
    'reservations.pickup': 'Recogida',
    'reservations.destination': 'Destino',
    'reservations.driver': 'Chofer',
    'reservations.vehicle': 'Vehículo',
    'reservations.cancel': 'Cancelar',
    'reservations.details': 'Ver Detalles',
    
    // Forms
    'form.name': 'Nombre',
    'form.lastname': 'Apellido',
    'form.email': 'Correo Electrónico',
    'form.password': 'Contraseña',
    'form.confirmPassword': 'Confirmar Contraseña',
    'form.phone': 'Teléfono',
    'form.address': 'Dirección',
    'form.submit': 'Enviar',
    'form.save': 'Guardar',
    'form.cancel': 'Cancelar',
    'form.edit': 'Editar',
    'form.delete': 'Eliminar',
    
    // Password Requirements
    'password.requirements': 'La contraseña debe contener:',
    'password.minLength': 'Mínimo 8 caracteres',
    'password.uppercase': 'Al menos una mayúscula',
    'password.number': 'Al menos un número',
    'password.special': 'Al menos un carácter especial (!@#$%^&*)',
    'password.match': 'Las contraseñas coinciden',
    'password.noMatch': 'Las contraseñas no coinciden',

    // Errors
    'errors.invalidCredentials': 'Usuario o contraseña incorrectos',
    'errors.mustLoginProfile': 'Debe iniciar sesión para ver el perfil',
    'errors.passwordMismatch': 'Las contraseñas no coinciden',
    'errors.passwordMinLength': 'La contraseña debe tener al menos 8 caracteres',
    'errors.passwordRequirements': 'La contraseña debe contener al menos una mayúscula y un número',
    'errors.passwordInvalid': 'La contraseña no es válida',
    'errors.usernameTaken': 'El nombre de usuario ya está en uso',
    'errors.usernameInvalid': 'El nombre de usuario no es válido',
    'errors.emailInvalid': 'Debe ingresar un correo electrónico válido',
    'errors.emailTaken': 'Este correo electrónico ya está registrado',
    'errors.emailRequired': 'El correo electrónico es requerido',
    'errors.registerFailed': 'No se pudo crear la cuenta',
    'errors.mustLoginChangePassword': 'Debe iniciar sesión para cambiar la contraseña.',
    'errors.currentPasswordIncorrect': 'La contraseña actual es incorrecta.',
    'errors.newPasswordMismatch': 'La nueva contraseña y la confirmación no coinciden.',
    'errors.passwordUpdateFailed': 'No se pudo actualizar la contraseña, intente de nuevo.',

    // Success
    'success.login': 'Inicio de sesión exitoso',
    'success.register': 'Cuenta creada correctamente',
    'success.passwordUpdated': 'Contraseña actualizada con éxito.',
    
    // Buttons
    'btn.reserve': 'Reservar',
    'btn.book': 'Reservar Ahora',
    'btn.viewMore': 'Ver Más',
    'btn.back': 'Volver',
    'btn.next': 'Siguiente',
    'btn.previous': 'Anterior',
    'btn.confirm': 'Confirmar',
    
    // Footer
    'footer.text': '© 2026 <span>Xservicios</span> - Transporte Turístico de Lujo. Todos los derechos reservados.',
    
    // Page Titles
    'page.title.home': 'Xservicios - Transporte Turístico de Lujo en Chiriquí',
    'page.title.about': 'Xservicios - Quiénes Somos | Transporte Turístico de Lujo',
    'page.title.fleet': 'Xservicios - Nuestra Flota | Vehículos de Lujo',
    'page.title.services': 'Xservicios - Nuestros Servicios | Tours y Traslados',
    'page.title.login': 'Xservicios - Iniciar Sesión',
    'page.title.signup': 'Xservicios - Crear Cuenta',
    'page.title.newReservation': 'Xservicios - Nueva Reserva',
    'page.title.myReservations': 'Xservicios - Mis Reservas',
    'page.title.profile': 'Xservicios - Mi Perfil',
    'page.title.dashboard': 'Xservicios - Panel de Control',
    'page.title.rateService': 'Xservicios - Valorar Servicio',
    'page.title.busDetails': 'Xservicios - Detalles del Vehículo',
    'page.title.driverDetails': 'Xservicios - Información del Conductor'
  },
  
  en: {
    // Navigation
    'nav.home': 'Home',
    'nav.fleet': 'View Fleet',
    'nav.services': 'Services',
    'nav.about': 'About Us',
    
    // Authentication
    'auth.login': 'Log In',
    'auth.user': 'User',
    'auth.signUp': 'Sign Up',
    'auth.rememberMe': 'Remember me',
    'auth.forgotPassword': 'Forgot your password?',
    'auth.loginTitle': 'Log In',
    'auth.loginSubtitle': 'Log in to any of your existing accounts',
    'auth.signUpTitle': 'Create an account',
    'auth.signUpSubtitle': 'Sign up to continue',
    'auth.username': 'Username',
    'auth.noAccount': "Don't have an account?",
    'auth.haveAccount': 'Already have an account?',
    
    // User Profile
    'profile.myProfile': 'My Profile',
    'profile.myReservations': 'My Reservations',
    'profile.settings': 'Settings',
    'profile.logout': 'Log Out',
    
    // Hero Section - Nosotros
    'hero.titlePart1': 'Luxury Tourist',
    'hero.titlePart2': 'Transportation',
    'hero.bookNow': 'Book Now',
    
    // Hero Section - Home Public
    'homeHero.title': 'VISIT<br><span>BOCAS DEL TORO</span>',
    'homeHero.desc1': '<strong>Unique experience.</strong> Discover amazing destinations with the best tourist transportation service.',
    'homeHero.desc2': '<strong>Guaranteed comfort.</strong> Travel safely and in style in our luxury vehicles.',
    'homeHero.desc3': '<strong>Expert guides.</strong> Trained staff to make your experience unforgettable.',
    
    // Hero Section - Home Login
    'homeLogin.heroTitle': 'Luxury tourist transportation in Chiriquí',
    'homeLogin.heroDesc': 'Book a safe, punctual and high quality transfer with Xservicios.',
    'homeLogin.newReservation': 'New Reservation',
    'homeLogin.quickSummary': 'Quick Summary',
    'homeLogin.myReservations': 'My Reservations',
    'homeLogin.rateService': 'Rate Service',
    'homeLogin.serviceHistory': 'Service History',
    'homeLogin.seeMore': 'See More',
    
    // About Section
    'about.title': 'Who We Are',
    'about.description': 'At Xservicios, we are a luxury tourist transportation system focused on providing safe, efficient, and high-quality transfers. Our operation is designed to serve customers who value comfort, punctuality, and reliable service, providing a mobility experience aligned with premium standards on every journey.',
    'about.button': 'Learn Our Story',
    
    // Gallery Section
    'gallery.title': 'Our Destinations',
    'gallery.subtitle': 'Discover the most beautiful places in Chiriquí with us',
    
    // Fleet Section
    'fleet.title': 'About Our Fleet',
    'fleet.description': 'Our fleet consists of modern and carefully maintained units, designed to guarantee comfort and safety at all times. We have two Coaster-type buses and two buses with capacity for 15 passengers, which allows us to efficiently handle tourist and corporate transfers, adapting to different needs without compromising service quality.',
    'fleet.viewDetails': 'View Details',
    'fleet.capacity': 'Capacity',
    'fleet.passengers': 'passengers',
    'fleet.available': 'Available',
    
    // Team Section
    'team.title': 'Our Team',
    'team.description': 'Our drivers are responsible, transparent professionals committed to their work. Each collaborator represents the values of Xservicios, standing out for their punctuality, respectful treatment and focus on safety, ensuring that each transfer is carried out with the professionalism and trust that our clients expect.',
    'team.button': 'Meet the Team',
    
    // Features Section
    'features.premium': 'Premium Service',
    'features.satisfied': 'Satisfied Customers',
    'features.punctual': 'Always On Time',
    'features.quality': 'High Quality',
    
    // Services Section
    'services.title': 'Our Services',
    'services.subtitle': 'Luxury tourist transportation services',
    'services.from': 'From',
    'services.bookNow': 'Book Now',
    
    // Reservations
    'reservations.title': 'My Reservations',
    'reservations.new': 'New Reservation',
    'reservations.status': 'Status',
    'reservations.pending': 'Pending',
    'reservations.confirmed': 'Confirmed',
    'reservations.completed': 'Completed',
    'reservations.cancelled': 'Cancelled',
    'reservations.date': 'Date',
    'reservations.time': 'Time',
    'reservations.pickup': 'Pickup',
    'reservations.destination': 'Destination',
    'reservations.driver': 'Driver',
    'reservations.vehicle': 'Vehicle',
    'reservations.cancel': 'Cancel',
    'reservations.details': 'View Details',
    
    // Forms
    'form.name': 'Name',
    'form.lastname': 'Last Name',
    'form.email': 'Email',
    'form.password': 'Password',
    'form.confirmPassword': 'Confirm Password',
    'form.phone': 'Phone',
    'form.address': 'Address',
    'form.submit': 'Submit',
    'form.save': 'Save',
    'form.cancel': 'Cancel',
    'form.edit': 'Edit',
    'form.delete': 'Delete',
    
    // Password Requirements
    'password.requirements': 'The password must contain:',
    'password.minLength': 'Minimum 8 characters',
    'password.uppercase': 'At least one uppercase letter',
    'password.number': 'At least one number',
    'password.special': 'At least one special character (!@#$%^&*)',
    'password.match': 'Passwords match',
    'password.noMatch': 'Passwords do not match',

    // Errors
    'errors.invalidCredentials': 'Incorrect username or password',
    'errors.mustLoginProfile': 'You must sign in to view your profile',
    'errors.passwordMismatch': 'Passwords do not match',
    'errors.passwordMinLength': 'Password must be at least 8 characters',
    'errors.passwordRequirements': 'Password must contain at least one uppercase letter and one number',
    'errors.passwordInvalid': 'Password is not valid',
    'errors.usernameTaken': 'Username is already in use',
    'errors.usernameInvalid': 'Username is not valid',
    'errors.emailInvalid': 'Please enter a valid email address',
    'errors.emailTaken': 'This email address is already registered',
    'errors.emailRequired': 'Email address is required',
    'errors.registerFailed': 'Account could not be created',
    'errors.mustLoginChangePassword': 'You must sign in to change your password.',
    'errors.currentPasswordIncorrect': 'Current password is incorrect.',
    'errors.newPasswordMismatch': 'New password and confirmation do not match.',
    'errors.passwordUpdateFailed': 'Password could not be updated. Please try again.',

    // Success
    'success.login': 'Signed in successfully',
    'success.register': 'Account created successfully',
    'success.passwordUpdated': 'Password updated successfully.',
    
    // Buttons
    'btn.reserve': 'Reserve',
    'btn.book': 'Book Now',
    'btn.viewMore': 'View More',
    'btn.back': 'Back',
    'btn.next': 'Next',
    'btn.previous': 'Previous',
    'btn.confirm': 'Confirm',
    
    // Footer
    'footer.text': '© 2026 <span>Xservicios</span> - Luxury Tourist Transportation. All rights reserved.',
    
    // Page Titles
    'page.title.home': 'Xservicios - Luxury Tourist Transportation in Chiriquí',
    'page.title.about': 'Xservicios - About Us | Luxury Tourist Transportation',
    'page.title.fleet': 'Xservicios - Our Fleet | Luxury Vehicles',
    'page.title.services': 'Xservicios - Our Services | Tours and Transfers',
    'page.title.login': 'Xservicios - Log In',
    'page.title.signup': 'Xservicios - Sign Up',
    'page.title.newReservation': 'Xservicios - New Reservation',
    'page.title.myReservations': 'Xservicios - My Reservations',
    'page.title.profile': 'Xservicios - My Profile',
    'page.title.dashboard': 'Xservicios - Dashboard',
    'page.title.rateService': 'Xservicios - Rate Service',
    'page.title.busDetails': 'Xservicios - Vehicle Details',
    'page.title.driverDetails': 'Xservicios - Driver Information'
  }
};

/**
 * Clase para manejar la internacionalización
 */
class I18n {
  constructor() {
    // Prioridad: localStorage > preload > default
    this.currentLang = this.getStoredLanguage() || window.__i18nPreloadLang || 'es';
    this.init();
  }

  /**
   * Inicializa el sistema de traducción
   */
  init() {
    console.log(`🌐 Inicializando i18n con idioma: ${this.currentLang}`);
    
    // Aplicar idioma actual
    this.setLanguage(this.currentLang, false);
    
    // Agregar eventos a los botones de idioma
    this.attachLanguageButtons();
    
    // Actualizar estado activo de los botones
    this.updateActiveLanguage();

    // Mostrar contenido después de aplicar traducciones
    if (document.body) {
      document.body.classList.add('i18n-ready');
      console.log('✅ i18n inicializado - contenido visible');
      // Remover el estilo de preload después de un momento
      setTimeout(() => {
        const preloadStyle = document.getElementById('i18n-preload-style');
        if (preloadStyle) {
          preloadStyle.remove();
        }
      }, 300);
    }
  }

  /**
   * Obtiene el idioma almacenado en localStorage
   */
  getStoredLanguage() {
    const lang = localStorage.getItem('preferredLanguage');
    if (lang) {
      console.log(`📖 Idioma leído de localStorage: ${lang}`);
    }
    return lang;
  }

  /**
   * Almacena el idioma preferido en localStorage
   */
  setStoredLanguage(lang) {
    localStorage.setItem('preferredLanguage', lang);
    console.log(`💾 Idioma guardado en localStorage: ${lang}`);
  }

  /**
   * Cambia el idioma de la página
   */
  setLanguage(lang, store = true) {
    if (!translations[lang]) {
      console.error(`Language ${lang} not found`);
      return;
    }

    this.currentLang = lang;
    
    if (store) {
      this.setStoredLanguage(lang);
    }

    // Actualizar atributo lang del HTML
    document.documentElement.setAttribute('lang', lang);

    // Traducir todos los elementos con data-i18n
    this.translatePage();

    // Actualizar estado activo de los botones
    this.updateActiveLanguage();

    // Disparar evento personalizado
    window.dispatchEvent(new CustomEvent('languageChanged', { detail: { language: lang } }));
  }

  /**
   * Traduce todos los elementos de la página
   */
  translatePage() {
    // Traducir el título de la página si tiene data-i18n
    const titleElement = document.querySelector('title[data-i18n]');
    if (titleElement) {
      const key = titleElement.getAttribute('data-i18n');
      const translation = translations[this.currentLang][key];
      if (translation) {
        document.title = translation;
      }
    }

    // Traducir elementos con data-i18n
    const elements = document.querySelectorAll('[data-i18n]');
    
    elements.forEach(element => {
      const key = element.getAttribute('data-i18n');
      const translation = translations[this.currentLang][key];
      
      if (translation) {
        // Si el contenido tiene HTML (como el span en footer), usar innerHTML
        if (translation.includes('<')) {
          element.innerHTML = translation;
        } else {
          element.textContent = translation;
        }
      } else {
        console.warn(`Translation key "${key}" not found for language "${this.currentLang}"`);
      }
    });

    // Traducir placeholders con data-i18n-placeholder
    const placeholderElements = document.querySelectorAll('[data-i18n-placeholder]');
    
    placeholderElements.forEach(element => {
      const key = element.getAttribute('data-i18n-placeholder');
      const translation = translations[this.currentLang][key];
      
      if (translation) {
        element.placeholder = translation;
      } else {
        console.warn(`Placeholder translation key "${key}" not found for language "${this.currentLang}"`);
      }
    });
  }

  /**
   * Actualiza el estado activo de los botones de idioma
   */
  updateActiveLanguage() {
    // Actualizar botón de idioma nuevo (único)
    const langButton = document.getElementById('langToggle');
    if (langButton) {
      const langCodeSpan = langButton.querySelector('.lang-code');
      if (langCodeSpan) {
        // Mostrar el idioma actual (no el opuesto)
        langCodeSpan.textContent = this.currentLang === 'es' ? 'ES' : 'EN';
      }
    }

    // Mantener compatibilidad con botones antiguos (si existen)
    const langButtons = document.querySelectorAll('.lang-text');
    langButtons.forEach(button => {
      const lang = button.getAttribute('data-lang');
      if (lang === this.currentLang) {
        button.classList.add('active');
      } else {
        button.classList.remove('active');
      }
    });
  }

  /**
   * Agrega eventos de clic a los botones de idioma
   */
  attachLanguageButtons() {
    // Manejar botón único de idioma
    const langToggle = document.getElementById('langToggle');
    if (langToggle) {
      langToggle.addEventListener('click', () => {
        const newLang = this.currentLang === 'es' ? 'en' : 'es';
        this.setLanguage(newLang);
        
        // Animación visual de feedback
        langToggle.style.transform = 'scale(0.95)';
        setTimeout(() => {
          langToggle.style.transform = 'scale(1)';
        }, 150);
      });
    }

    // Mantener compatibilidad con botones antiguos (si existen)
    const langButtons = document.querySelectorAll('.lang-text');
    langButtons.forEach(button => {
      button.addEventListener('click', (e) => {
        const lang = e.target.getAttribute('data-lang');
        if (lang && lang !== this.currentLang) {
          this.setLanguage(lang);
          
          // Animación visual de feedback
          button.style.transform = 'scale(1.1)';
          setTimeout(() => {
            button.style.transform = 'scale(1)';
          }, 200);
        }
      });
    });
  }

  /**
   * Obtiene una traducción específica por clave
   */
  t(key) {
    return translations[this.currentLang][key] || key;
  }

  /**
   * Obtiene el idioma actual
   */
  getCurrentLanguage() {
    return this.currentLang;
  }
}

// Inicializar el sistema de traducción cuando el DOM esté listo
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    window.i18n = new I18n();
  });
} else {
  window.i18n = new I18n();
}

// Exponer funciones útiles globalmente
window.setLanguage = (lang) => {
  if (window.i18n) {
    window.i18n.setLanguage(lang);
  }
};

window.getCurrentLanguage = () => {
  return window.i18n ? window.i18n.getCurrentLanguage() : 'es';
};

window.translate = (key) => {
  return window.i18n ? window.i18n.t(key) : key;
};
