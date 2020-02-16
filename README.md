# Quasar OAuth App for Laravel

[![Total Downloads](https://poser.pugx.org/quasar/oauth/downloads)](https://packagist.org/packages/quasar/oauth)
[![Latest Stable Version](http://img.shields.io/github/release/syscover/quasar-oauth.svg)](https://packagist.org/packages/quasar/oauth)

Quasar is a application that generates a control panel where you can create custom solutions.

---

## Installation

**1 - After install Laravel framework, execute on console:**
```
composer require quasar/oauth
```

**2 - Execute publish command**
```
php artisan vendor:publish --provider="Quasar\OAuth\OAuthServiceProvider"
```

**3 - Execute migrations and seed database**
```
composer dump-autoload
php artisan migrate
php artisan db:seed --class="OAuthSeeder"
```

**4 - Add graphQL routes to graphql/schema.graphql file**
```
# OAuth
#import ./../vendor/quasar/oauth/src/Quasar/OAuth/GraphQL/inputs.graphql
#import ./../vendor/quasar/oauth/src/Quasar/OAuth/GraphQL/types.graphql

type Query {
    # others imports

    # OAuth
    #import ./../vendor/quasar/oauth/src/Quasar/OAuth/GraphQL/queries.graphql
}

type Mutation {
    # others imports

    # OAuth
    #import ./../vendor/quasar/oauth/src/Quasar/OAuth/GraphQL/mutations.graphql
}
```