# Wordpress Installer Pack
This repository purpose his to install a new Wordpress (5.2.4) faster, with all main plugins, for translations, security, SEO or custom content.
<br /><br />
Git repository : https://github.com/gledonne-sutunam/wordpress-installer-pack<br />

# Requirements
- PHP version : 7.2
 
# Plugins list

## Wordpress tools
- Classic Editor (disabled)
- Duplicate Post
- Admin Menu Editor

## Server & App settings
- WP Crontrol
- WP OAuth Server (disabled) : coule be needed to plug API
- WP Mail SMTP<br />
## Custom content
- Advanced Custom Fields PRO
- Max Mega Menu
- Contact Form 7<br />

## Spam and Privacy
- Akismet Anti-Spam
- Invisible reCaptcha
- GDPR Cookie Consent<br />

## Translations
- Theme and plugin translation for Polylang (TTfP)
- ACF Options for Polylang
- Contact Form 7 Polylang extension
- Polylang<br />

## SEO
- Yoast SEO
- Site Kit by Google : Google Analytics, GTM, Search Console, ...
- Simple 301 Redirects
- Simple 301 Redirects - Addon - Bulk CSV Uploader<br />

## Images Management
- Regenerate Thumbnails
- Simple Image Sizes
- SVG Support
- WP Media Categories<br />

## Performance
- W3 Total Cache
- Smush<br />

## Security
- iThemes Security : to setup at the end of project<br />

## Theme
- Default Wordpress theme is twentynineteen.
- To keep custom function when updating Wordpress, please use the child-theme (already active).
- Search Engine Visibility is OFF : 
- There is no compiler as GULP installed yet.</br>

## Admin
- /wp-admin
- User : gledonne@sutunam.com
- Password : gledonne-sutunam<br /><br />
Please remove this user after creating your own.<br />

# SETUP PROJECT

## Files
```
cd public_html
git clone git@github.com:gledonne-sutunam/wordpress-installer-pack.git
git config --global user.email "your-name@email.com"
git config --global user.name "Your Name"
```
## Database
```
cd public_html
sed -i 's/wordpress-installer-pack.local/your-domain.com/g' .backups/wordpress_installer_pack.sql
mysql -h HOST -u USER -p DB_NAME < .backups/wordpress_installer_pack.sql
```

Update the file wp-config.php with your own database informations :<br />

```
define( 'DB_NAME', 'wordpress_installer_pack' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
```

Don't forget to add wp-config and .htaccess in your gitignore :<br />

```
.htaccess
wp-config.php
```

Then reset your permalinks from admin :<br />
/wp-admin/options-permalink.php
