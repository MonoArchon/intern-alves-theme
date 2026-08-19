- **Custom Theme**: `wp-content/themes/_elementor-starter/`
- WordPress core, plugins, and uploads are excluded via [.gitignore](.gitignore) — the server is the source of truth for those.
 
 
Custom widgets live inside the theme (no separate plugin needed). The autoloader in [app/app.php](wp-content/themes/_elementor-starter/app/app.php) auto-discovers any `Elem_*` class.
 
**Convention:** `Elem_Foo` → loads from `app/modules/elementor/widgets/foo/foo.php`
 
### Steps
 
1. **Create the widget file** at `app/modules/elementor/widgets/<name>/<name>.php`. Use [widgets/header/header.php](wp-content/themes/_elementor-starter/app/modules/elementor/widgets/header/header.php) as a template:
 
   ```php
<?php
   defined( 'ABSPATH' ) or exit;
   use Elementor\Controls_Manager;
   use Elementor\Widget_Base;
 
   class Elem_Hero extends Widget_Base {
     public function get_title(): string { return 'Hero'; }
     public function get_name(): string { return __CLASS__; }
     public function get_categories(): array { return [ 'custom' ]; }
 
     protected function register_controls() { /* ... */ }
     protected function render() { /* ... */ }
   }
   ```
 
2. **Register it** in [app/modules/elementor/elementor.php](wp-content/themes/_elementor-starter/app/modules/elementor/elementor.php) inside `init_widgets()`:
 
   ```php
   Plugin::instance()->widgets_manager->register( new Elem_Hero() );
   ```
 
3. **(Optional) Add styles** — drop `<name>.scss` in the same folder. The widget base auto-registers `dist/css/<name>.min.css`, so run the build before committing (see below).
 
4. **Push** — widget appears in Elementor editor under the **"Custom App Widgets"** category within ~20 seconds.
 
### Custom Dynamic Tags
 
Same pattern, different folder: `Elem_Tag_Foo` → `app/modules/elementor/tags/foo.php`. Register inside `init_dynamic_tags()` in `elementor.php`.
 
## Theme Build (SCSS / JS)
 
From `wp-content/themes/_elementor-starter/`:
 
```bash
yarn install        # first time only
yarn watch          # dev mode, watches for changes
yarn build          # production build, outputs to dist/
```
 
Commit the compiled `dist/` files alongside the source — they get deployed and referenced by the widgets.