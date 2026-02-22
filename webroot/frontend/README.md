# Frontend HTML Files - Xservicios

## 📁 File Index

This directory contains all static HTML pages for the Xservicios frontend application.

### Public Pages (No Authentication Required)

| File | Description | Route |
|------|-------------|-------|
| `home.html` | Main landing page | `/` or `/frontend/home` |
| `about.html` | About us / Company information | `/frontend/about` |
| `services.html` | Available services catalog | `/frontend/services` |
| `fleet.html` | Vehicle fleet gallery | `/frontend/fleet` |
| `login.html` | User login page | `/frontend/login` |
| `signup.html` | User registration page | `/frontend/signup` |

### Authenticated Pages (Login Required)

| File | Description | Route |
|------|-------------|-------|
| `dashboard.html` | User dashboard / Home authenticated | `/home` (when logged in) |
| `new-reservation.html` | Create new reservation form | `/frontend/newreservation` |
| `my-reservations.html` | User's reservation list | `/frontend/myreservations` |
| `rate-service.html` | Service rating page | `/frontend/rateservice` |

### Detail Pages

| File | Description | Access |
|------|-------------|--------|
| `bus-details.html` | Vehicle technical specifications | Direct access |
| `driver-details.html` | Driver profiles and information | Direct access |

---

## 🎨 Features

All pages include:
- ✅ **Dynamic Header**: Auto-loaded with authentication state
- ✅ **i18n Support**: Spanish/English language switcher
- ✅ **Responsive Design**: Mobile-first approach
- ✅ **CSRF Protection**: Token injection via FrontendController
- ✅ **Consistent Styling**: Unified design system

---

## 🔧 Technical Implementation

### Required Scripts (Load Order Important!)

```html
<!-- At the end of <body> tag -->
<script src="/js/header-loader.js"></script>    <!-- 1. Injects header HTML -->
<script src="/js/header-dynamic.js"></script>   <!-- 2. Handles authentication -->
<script src="/js/i18n.js"></script>             <!-- 3. Manages translations -->
</body>
```

### Translation Attributes

Use `data-i18n` for translatable content:

```html
<h1 data-i18n="page.title">Spanish Text</h1>
<input type="text" data-i18n-placeholder="form.name" placeholder="Nombre">
```

---

## 📝 Naming Conventions

All files follow international standards:
- **Language**: English
- **Case**: kebab-case (words-separated-by-hyphens)
- **Format**: lowercase only
- **Extension**: `.html`

### Examples
- ✅ `my-reservations.html` 
- ✅ `rate-service.html`
- ❌ `MisReservas.html` (Spanish + CamelCase)
- ❌ `valorar_servicios.html` (Spanish + snake_case)

---

## 🚀 Adding New Pages

1. **Create the HTML file**:
   ```bash
   touch webroot/frontend/my-new-page.html
   ```

2. **Include header scripts**:
   ```html
   <script src="/js/header-loader.js"></script>
   <script src="/js/header-dynamic.js"></script>
   <script src="/js/i18n.js"></script>
   ```

3. **Add route in FrontendController.php** (optional):
   ```php
   public function myNewPage()
   {
       $this->response = $this->response->withType('text/html');
       $content = file_get_contents(ROOT . '/webroot/frontend/my-new-page.html');
       $content = $this->injectCsrfToken($content);
       return $this->response->withStringBody($content);
   }
   ```

4. **Add translations** in `i18n.js` if needed

---

## 🌐 Internationalization

Language files are managed in `/js/i18n.js`:
- Spanish (ES) - Default
- English (EN)

Add new translations:
```javascript
const translations = {
  es: { 'myKey': 'Mi Texto' },
  en: { 'myKey': 'My Text' }
};
```

---

## 🔐 Authentication Flow

1. **Unauthenticated**: Shows "Login" button in header
2. **Authenticated**: Shows user profile with dropdown:
   - My Profile
   - My Reservations
   - Settings
   - Logout

Authentication is managed automatically by `header-dynamic.js` via:
- API: `/xserv-usuarios/me`
- Logout: `/logout`

---

## 📦 Dependencies

### External
- Google Fonts: Playfair Display, Inter
- No external CSS frameworks (custom design)

### Internal
- CakePHP 5.x (backend)
- Custom JavaScript (ES6+)
- LocalStorage API (language preference, user cache)

---

## 🐛 Troubleshooting

### Header not loading?
1. Check console for JavaScript errors
2. Verify script load order (header-loader → header-dynamic → i18n)
3. Ensure files are in `/js/` directory

### Translations not working?
1. Check `data-i18n` attribute syntax
2. Verify key exists in `i18n.js`
3. Clear localStorage: `localStorage.clear()`

### Authentication not showing?
1. Check `/xserv-usuarios/me` endpoint response
2. Verify CSRF token in cookies
3. Check browser console for API errors

---

## 📚 Documentation

- [Header Component Guide](../../docs/HEADER_COMPONENT.md)
- [Migration Guide](../../docs/FILE_NAMING_MIGRATION.md)
- [API Documentation](../../docs/API.md) _(if available)_

---

## 👥 Maintenance

**Last Updated**: February 22, 2026  
**File Count**: 12 HTML files  
**Status**: ✅ All files using standardized naming

---

## 📄 License

Part of Xservicios proprietary application.  
© 2026 Xservicios - All rights reserved.
