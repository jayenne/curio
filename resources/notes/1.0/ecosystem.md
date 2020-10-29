# Ecosystem

---
- [Vagrant](#vagrant)
- [Homestead](#homestead)
- [Laravel](#laravel)
- [Mix](#mix)
- [Horizon](#horizon)
- [Telescope](#telescope)
- [Dusk](#dusk)
- [Tinker](#tinker)
- [Nova](#nova)
- [Mailhog](#mailhog)
- [PHPUnit](#phphunit)
- [Clockwork (debug)](#clockwork)

## Environment
<a name="virtualbox">Virtual Box</a>
VirtualBox is a powerful x86 and AMD64/Intel64 virtualization product for enterprise as well as home use. VirtualBox is an extremely feature rich, high performance product for enterprise customers. 

###VirtualBox
[Site](https://www.virtualbox.org/)

<a name="vagrant">Vagrant</a>
### Vagrant
Vagrant is a tool for building and managing virtual machine environments in a single workflow. With an easy-to-use workflow and focus on automation, Vagrant lowers development environment setup time, increases production parity, and makes the "works on my machine" excuse a relic of the past.
[Site](https://www.vagrantup.com)

## Server
<a name="homestead"></a>
### Laravel Homestead
Laravel Homestead is an official, pre-packaged Vagrant box that provides you a wonderful development environment without requiring you to install PHP, a web server, and any other server software on your local machine. No more worrying about messing up your operating system! Vagrant boxes are completely disposable. If something goes wrong, you can destroy and re-create the box in minutes!
- NGINX
- PHP 7
- MYSQL

- [Laravel Horizon](https://laravel.com/docs/6.x/homestead)

## Framework
<a name="laravel"></a>
### Laravel (~6.)
Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.

- [Laravel](https://laravel.com)

## Laravel Mix / Webpack
<a name="mix"></a>
### Laravel Mix
Laravel Mix provides a fluent API for defining Webpack build steps for your Laravel application using several common CSS and JavaScript pre-processors. Through simple method chaining, you can fluently define your asset pipeline.

- [Laravel Mix](https://laravel.com/docs/6.x/mix)

## Monitors & Debugging
<a name="horizon"></a>
### Laravel Horizon
Horizon provides a beautiful dashboard and code-driven configuration for your Laravel powered Redis queues. Horizon allows you to easily monitor key metrics of your queue system such as job throughput, runtime, and job failures.
All of your worker configuration is stored in a single, simple configuration file, allowing your configuration to stay in source control where your entire team can collaborate.

- [Laravel Horizon](/horizon)


<a name="telescope"></a>
### Laravel Telescope
Telescope is an elegant debug assistant for the Laravel framework. Telescope provides insight into the requests coming into your application, exceptions, log entries, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, variable dumps and more. Telescope makes a wonderful companion to your local Laravel development environment.

- [Laravel Telescope](/telescope)

## Developent Tools

<a name="dusk"></a>
### Laravel Dusk
Laravel Dusk provides an expressive, easy-to-use browser automation and testing API. By default, Dusk does not require you to install JDK or Selenium on your machine. Instead, Dusk uses a standalone ChromeDriver installation. However, you are free to utilize any other Selenium compatible driver you wish.

- [Laravel Dusk](https://laravel.com/docs/6.x/dusk)

<a name="tinker"></a>
### Laravel Tinker
Laravel Tinker is a powerful REPL for the Laravel framework.

- [Laravel Tinker](https://github.com/laravel/tinker)

>{light.fa-none} We also user Tinkerwell app/online tool [here](https://web.tinkerwell.app/)


## Administration tools
<a name="nova"></a>
### Laravel Nova

Nova is a beautifully designed administration panel for Laravel. Carefully crafted by the creators of Laravel to make you the most productive developer in the galaxy. 
- [Laravel Nova](https://nova.laravel.com/)

<a name="mailhog"></a>
### Mailhog
MailHog is an email testing tool for developers:
    Configure your application to use MailHog for SMTP delivery;
    View messages in the web UI, or retrieve them with the JSON API;
    Optionally release messages to real SMTP servers for delivery.


- [Mailhog](http://192.168.10.10:8025/)

<a name="phpunit"></a>
### PHP Unit
PHPUnit is a programmer-oriented testing framework for PHP.
It is an instance of the xUnit architecture for unit testing frameworks.

- [PHPUnit](https://phpunit.de/)
- [Docs](https://phpunit.de/documentation.html)
- [Tuts](https://laravel.com/docs/6.x/http-tests)

<a name="clockwork"></a>
### Clockwork (w/browser plugin)
Clockwork is a browser extension, providing tools for debugging and profiling your PHP applications, including request data, application log, database queries, routes, visualisation of application runtime and more.

Clockwork uses a server-side component, that gathers all the data and easily integrates with any PHP project, including out-of-the-box support for major frameworks.

[Site](https://underground.works/clockwork/)
[Git](https://github.com/itsgoingd/clockwork)