# ![](./templates/night2015/img/favicon/favicon-32x32.png) MyLocal 
>    MyLocal is a responsive dashboard for your web development environment.  
>    Try it if you are bored of your localhost home page!  

## Why I should use this crap?
1. Include a directory listing *(like every dashboard)*
2. Automatic detection of GitHub repository link
3. Automatic detection of Bitbucket repository link
4. Automatic detection of SVN repository link
5. No database requirement
6. Work with [a lot](#build-status-) of OS, development environment and PHP version. 
7. Custom CSS & JS area
8. it's easy to make your own myLocal template.
9. Is made with  :green_heart: && :coffee: under a [public license](./license.md)

## Requirements

* PHP 5 -> 7
* [xampp](https://www.apachefriends.org/index.html) || [wamp](http://www.wampserver.com/en/) || [mamp](https://www.mamp.info/en/)

## How to instal?  *(auto installer coming soon!)*

Clone or paste myLocal foler in your web development environment (xampp, wamp or mamp) root folder (htdocs or www).

   **How to load it in my localhost homepage?**   
   If you want to load myLocal dashboard instead of your classic environment's dashboard you can pasted `myLocal/include.php` in your root folder and renamed it to `index.php`.   

   **How to rename myLocal main folder?**   
   If you want to rename myLocal main folder you need to go in `myLocal/config/defines.php`, update row 7 `define("MAIN_FOLDER_NAME", "yourFolderName");`. If you load it in your localhost homepage you also need to change path in your `/index.php` row 2.    


## Contributing Developers

Required [Compass](http://compass-style.org/) && [Gulp](https://www.npmjs.com/package/gulp-install) for any template update.

* Build JS: `gulp script-concat`
* Buils CSS: `gulp compass`
* Watch both: `gulp watch`


## Build status ![v 0.3.2](https://img.shields.io/badge/version-0.3.2_alpha-blue.svg)

| Linux | Windows | Mac | PHP |
|:------:|:----------:|:----:|:----:|
| ![xampp ok](https://img.shields.io/badge/XAMPP_Build-passing-brightgreen.svg) | ![xampp ok](https://img.shields.io/badge/XAMPP_Build-passing-brightgreen.svg) |  ![xampp ok](https://img.shields.io/badge/XAMPP_Build-passing-brightgreen.svg) | ![PHP 5.3 ok](https://img.shields.io/badge/5.3-passing-brightgreen.svg) |
| | ![wampp ok](https://img.shields.io/badge/WAMPP_Build-passing-brightgreen.svg) | ![mampp ok](https://img.shields.io/badge/MAMPP_Build-passing-brightgreen.svg) | ![PHP 5.5 ok](https://img.shields.io/badge/5.5-passing-brightgreen.svg) |
|| | | ![PHP 5.6 ok](https://img.shields.io/badge/5.6-passing-brightgreen.svg) |
|| | | ![PHP 7.0 ok](https://img.shields.io/badge/7.0-passing-brightgreen.svg) |


## License

This software is distributed under the [GNU 3.0](./license.md) license.


## Contributors

* [Fugu](http://www.fugu.fr/)
* [Golga](https://github.com/Golgarud)
* [Jiedara](https://github.com/Jiedara)


## Contribut
* [![fork](https://img.shields.io/badge/Code-Fork-brightgreen.svg)](https://github.com/Golgarud/myLocal/fork)
* [![download](https://img.shields.io/badge/Code-Download-blue.svg)](https://github.com/Golgarud/myLocal/archive/master.zip)
* [![Donate with paypal](https://img.shields.io/badge/Donate-PayPal-yellow.svg)](https://www.paypal.me/golga)
* [![Donate with bitcoin](https://img.shields.io/badge/Donate-ɃitCoin-green.svg)](https://greenaddress.it/fr/pay/GA2f9ovyx43qac7HH3Q9wwTDDJbiNU/#/)
