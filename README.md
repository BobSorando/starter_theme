Skip to content
Search or jump to…
Pull requests
Issues
Marketplace
Explore
 
@BobSorando 
BobSorando
/
starterpack
Public
1
00
Code
Issues
Pull requests
Actions
Projects
Wiki
Security
Insights
Settings
starterpack/README.md
@BobSorando
BobSorando Add files via upload
Latest commit 2f221b6 on 20 May
 History
 1 contributor
152 lines (108 sloc)  6.54 KB
   
OptimizedHTML 5
Lightweight production ready Gulp starter.

Start HTML Template

OptimizedHTML 5 - lightweight startup environment with Gulp 4, Preprocessors (Sass, Scss, Less, Stylus), clean-css, Browsersync, Autoprefixer, webpack-stream, Babel, Rsync, CSS Reboot (Bootstrap reboot), Server-side HTML imports (SSI), build. It uses best practices for responsive images, JavaScript, CSS optimizing and contains a .htaccess code for resources caching (images, fonts, HTML, CSS, JS and other content types).

How to use OptimizedHTML 5
Clone into the current folder and remove all unnecessary (one command):

git clone https://github.com/BobSorando/starter_theme.git .; rm -rf trunk .gitignore readme.md .git dist
Clone or Download OptimizedHTML 5 from GitHub
Install Node Modules: npm i
Run: gulp
Main Gulpfile.js options:
preprocessor: Optional preprocessor (sass, less, styl). 'sass' also work with the Scss syntax in "styles/sass/blocks/" import folder
fileswatch: List of files extensions for watching & hard reload
Main Gulp tasks:
gulp: run default gulp task (scripts, images, styles, browsersync, startwatch)
scripts, styles, images, assets: build assets (css, js, images or all)
deploy: project deployment via RSYNC
build: project build
Basic rules
src's & dist's:
All src | dist scripts located in app/js/app.js | app.min.js
Main Sass|Less|Styl src files located in app/styles/{preprocessor}/main.*
All compressed styles located in app/css/main.min.css
Project styles config placed in app/styles/{preprocessor}/_config.*
All src images placed in app/images/src/ folder
All compressed images placed in app/images/dist/ folder
Include parts of HTML code:
Include parts of html code is implemented using SSI Browsersync server side. You can import any part of the code using construction in any of html files:

<!--#include virtual="/parts/header.html" -->
Variables? No problem:

<!--#set var="title" value="OptimizedHTML 5" -->
<!--#include virtual="/parts/header.html" -->
In "/parts/header.html":

<title><!--#echo var="title" --></title>
Include parts of Preprocessor code:
All included parts of preprocessor files placed in the folder "styles/{preprocessor}/blocks/". Any number of preprocessor files can be placed here and in any order. They will be automatically included in the "styles/{preprocessor}/main.*" file and processed by the selected preprocessor.

Included features
bootstrap-reboot - Bootstrap Reboot CSS collection
_breakpoints.scss - Bootstrap Breakpoints mixin (available only for sass and scss)
bootstrap-grid (optional) - Bootstrap Grid collection
Helpers
Fonts
The woff2 fonts are currently recommended.

Converter recommended: https://www.fontsquirrel.com/tools/webfont-generator
Or get from google-webfonts-helper: https://google-webfonts-helper.herokuapp.com/fonts

font-weight helper
100 - Extra Light or Ultra Light
200 - Light or Thin
300 - Book or Demi
400 - Regular or Normal
500 - Medium
600 - Semibold or Demibold
700 - Bold
800 - Black or Extra Bold or Heavy
900 - Extra Black or Fat or Ultra Blac or Heavy
Caching
Create or open .htaccess file in root folder of website (Apache). Place this code for resources caching:

<ifModule mod_expires.c>

# Add correct content-type for fonts & SVG
AddType application/font-woff2 .woff2
AddType image/svg+xml .svg

ExpiresActive On
ExpiresDefault "access plus 5 seconds"

# Cache Images
ExpiresByType image/x-icon "access plus 2592000 seconds"
ExpiresByType image/jpeg "access plus 2592000 seconds"
ExpiresByType image/png "access plus 2592000 seconds"
ExpiresByType image/gif "access plus 2592000 seconds"
ExpiresByType image/svg+xml "access plus 2592000 seconds"

# Cache Fonts
ExpiresByType application/font-woff2 "access plus 2592000 seconds"
ExpiresByType image/svg+xml "access plus 2592000 seconds"

# Cache other content types (CSS, JS, HTML, XML)
ExpiresByType text/css "access plus 604800 seconds"
ExpiresByType text/javascript "access plus 2592000 seconds"
ExpiresByType application/javascript "access plus 2592000 seconds"
ExpiresByType application/x-javascript "access plus 2592000 seconds"
ExpiresByType text/html "access plus 600 seconds"
ExpiresByType application/xhtml+xml "access plus 600 seconds"

</ifModule>

<ifModule mod_deflate.c>

AddOutputFilterByType DEFLATE text/html text/plain text/xml application/xml application/xhtml+xml text/css text/javascript application/javascript application/x-javascript application/font-woff2 image/svg+xml

</ifModule>
Issues
Long Preprocessor compile: Disable the "safe write" option in PHPStorm settings.
© 2021 GitHub, Inc.
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About
Loading complete
