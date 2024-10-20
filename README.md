<p align="center"><img src="https://www.giandonatoinverso.it/qrcode/dist/img/DynamicQRCode_Original.png"></p>

**PHP Dynamic Qr code** is a script that allows the generation and saving of dynamic and static QR codes. It has a clean, responsive, and user-friendly design. It is based on [AdminLte](https://adminlte.io/), the "Best open source admin dashboard & control panel theme. Built on top of Bootstrap" and [Core PHP Admin Panel](https://github.com/chetans9/core-php-admin-panel), a simple Admin Panel written in core PHP that contains an implementation of general features you might need in your website admin panel like: record management (CRUD), secure authentication, pagination, filters.

[LIVE DEMO](https://giandonatoinverso.it/qrcode)

[DOCUMENTATION](https://giandonatoinverso.it/qrcode/documentation)

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=UEYVHYZYCGYYN)

contact me at hello@giandonatoinverso.dev for installations, custom implementations and to find out about available non-open source plugins

# Features

- **#1 Dynamic Qr code generator on GitHub with a database to store Qr codes**
- Create unlimited Qr codes
- Easy installation wizard
- Docker compose support
- Control panel with 2 access levels
- Multi-account 
- Dashboard with advanced statistics on Qr codes created and on scans
- Bulk download, bulk delete
- Dynamic Qr code
    - Create, modify, and delete Qr codes
    - You can download your Qr codes when you want
    - URL shortener with redirect
    - Enable or disable the link redirect
- Static Qr code
    - Text QR Code
    - Email QR Code
    - Phone QR Code
    - Sms QR Code
    - Whatsapp QR Code
    - Skype QR Code
    - Location QR Code
    - Vcard QR Code
    - Event/calendar QR Code
    - Bookmark QR Code
    - Wifi QR Code
    - Paypal QR Code
    - Bitcoin QR Code
- Customization of Qr codes
    - 6 formats for images
    - Foreground color
    - Background color
    - 4 levels of precision
    - 10 sizes
- Responsive bootstrap-based design
- Easy to understand and expand code
- Full OOP with classes and well-documented

The project requires at least PHP 7.4 to run properly. It has been successfully tested up to PHP 8.1.

## What is included

- PHP files
- .sql file with sample data
- JS files
- CSS files
- Docker compose file

## Setup with docker compose (simplest method)
1. download docker-compose.yml file
2. Start docker stack
```bash
docker compose build --no-cache && docker compose up -d
```
3. Open your browser at http://localhost:80 and login with (username: superadmin, password: superadmin)

For other setup methods please see the documentation

## Changelog

- Version 1.0 – September, 2020 (Initial release)
- Version 2.0 – 15th October, 2023
    - Elimination of superfluous files
    - Moving read.php file within the project
    - Addition of Qrcode class abstraction
    - Improvement of bulk download
    - General refactoring
- Version 2.1 – 16th October, 2023
    - Refactoring database tables
    - Added script for upgrading to versions >= 2.0
    - NEW: added multi-user support for dynamic/static qrcodes
- Version 2.2 – 16th October, 2023
    - Refactoring docker image building
    - NEW: added docker-compose support
