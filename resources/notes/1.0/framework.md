# Overview of Framework

---
- [Passport](#passport)
- [Socialite](#socialite)
- [Echo](#echo)
- [Scout](#scout)
- [Cashier](#cashier)
- [Dingo API](#dingo)
- [Axios (HTTP Promises)](#axios)
- [Vue.Js](vuejs)
- [Bootstrap-Vue](bootstrap-vue)
## Packages
<a name="passport"></a>
### Laravel Passport
Laravel already makes it easy to perform authentication via traditional login forms, but what about APIs? APIs typically use tokens to authenticate users and do not maintain session state between requests. Laravel makes API authentication a breeze using Laravel Passport, which provides a full OAuth2 server implementation for your Laravel application in a matter of minutes.

- [Laravel Socialite](https://laravel.com/docs/6.x/passport)

<a name="socialite"></a>
### Laravel Soclialite
In addition to typical, form based authentication, Laravel also provides a simple, convenient way to authenticate with OAuth providers using Laravel Socialite. Socialite currently supports authentication with Facebook, Twitter, LinkedIn, Google, GitHub, GitLab and Bitbucket.

- [Laravel Socialite](https://laravel.com/docs/6.x/socialite)

<a name="echo"></a>
### Laravel Echo
In many modern web applications, WebSockets are used to implement realtime, live-updating user interfaces. When some data is updated on the server, a message is typically sent over a WebSocket connection to be handled by the client. This provides a more robust, efficient alternative to continually polling your application for changes.
To assist you in building these types of applications, Laravel makes it easy to "broadcast" your events over a WebSocket connection. Broadcasting your Laravel events allows you to share the same event names between your server-side code and your client-side JavaScript application.

- [Laravel Echo](https://laravel.com/docs/6.x/broadcasting)

<a name="scout"></a>
## Laravel Scout
Laravel Scout provides a simple, driver based solution for adding full-text search to your Eloquent models. Using model observers, Scout will automatically keep your search indexes in sync with your Eloquent records.

- [Laravel Scout](https://laravel.com/docs/6.x/scout)

<a name="cashier"></a>
### Laravel Cashier
Laravel Cashier provides an expressive, fluent interface to Stripe's subscription billing services. It handles almost all of the boilerplate subscription billing code you are dreading writing. In addition to basic subscription management, Cashier can handle coupons, swapping subscription, subscription "quantities", cancellation grace periods, and even generate invoice PDFs.

- [Laravel Cashier](https://laravel.com/docs/6.x/billing)

<a name="stripe-laravel"></a>
### Stripe Laravel (cashier alternative)
A comprehensive PHP Library for Stripe / Laravel.
This package requires PHP 5.5.9+ and follows the FIG standards PSR-1, PSR-2 and PSR-4 to ensure a high level of interoperability between shared PHP.
- [Stripe-Laravel](https://github.com/cartalyst/stripe-laravel)
- [Docs](https://cartalyst.com/manual/stripe/2.0#introduction)

<a name="dingo"></a>
### Dingo API
A comprehensive PHP Library for Stripe / Laravel.
This package requires PHP 5.5.9+ and follows the FIG standards PSR-1, PSR-2 and PSR-4 to ensure a high level of interoperability between shared PHP.
- [Dingo](https://github.com/dingo/api)
- [Docs](https://github.com/dingo/api/wiki)
- [Tuts](https://m.dotdev.co/test-driven-api-development-using-laravel-dingo-and-jwt-with-documentation-ae4014260148)

<a name="axios"></a>
### Axios
Promise based HTTP client for the browser and node.js.
- [Site](https://github.com/axios/axios)

<a name="vuejs"></a>
### Vue.js
Vue is a progressive framework for building incrementally adoptable user interfaces and is easy to pick up and integrate with other libraries within existing projects.
[Site](https://vuejs.org/v2/)
[Guide](https://vuejs.org/v2/guide/)

<a name="bootstrap-vue"></a>
### Bootstrap Vue
With BootstrapVue you can build responsive, mobile-first, and ARIA accessible projects on the web using Vue.js and the world's most popular front-end CSS library
- [Site](https://bootstrap-vue.js.org/)
- [Docs](https://bootstrap-vue.js.org/docs/)

