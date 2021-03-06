# Reorg Case Study
I used homestead to host this. I left all my dbs and app ids in the configs just to save 
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

You can also add a second argument for batch size there incase you are loading a lot of records and want to avoid throttling: `php bin/console app:get-payments 1000 100` will download them in increments of 100. 

Next, to index run `php bin/console app:index-payments`

Now you should be able to load the website and make some searches!
