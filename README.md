# Reorg Case Study
I used homestead to build this. I left all my configs set up with dbs and app ids just to save 
you some set up time if you don't want to register a new app. If you do, it's located in `config/services.yaml`

Requires a MySQL database, an Elasticsearch instance, and Node

`php bin/console` commands should be run from the project root folder

Your webserver needs to load `public/index.php`

## Downloading requirements

From your root dir run: `composer install` and `yarn install`

## Database
You can find the queries used to generate tables in `src/Migrations`

1. Set database info in .env under `DATABASE_URL=`
2. Create database `php bin/console doctrine:database:create`
3. Run migrations `php bin/console doctrine:migrations:migrate`

## Javascript
Run `yarn run encore dev` to generate js and css assets

## Getting data scripts
Run `php bin/console app:get-payments 1000` to get payments from the external API. 
The first argument is the amount of records you want to pull from the API. I put a limit on this so I didn't have to wait for downloads when deving
You can add a second argument for batch size there incase you are loading a lot of records

Next, to index run `php bin/console app:index-payments`

Now you should be able to load the website and make some searches!

## Major todo: 
Plan on adding RabbitMQ so xls files can be generated asynchronously. Everything still works at the moment, but having a queue running to generate those files is a lot better pattern than running a cli command during a request.
