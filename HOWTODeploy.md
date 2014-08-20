Laravel Deployment
==========================

Overview
--------

While using git makes it easy to pull any revised code into a new environment, there are some manual steps that need to be done to facilitate this.  These steps could be automated, but they're simple enough.

Steps
-----

1. `git stash` - stash any *local changes* like composer updates that aren't stored in the repository
2. `git pull` - pull the fresh data from the upstream repository
3. If necessary, stop services, such as MySQL, Apache, Supervisor, etc. Composer is evidently a memory hog. It will become apparent if it is necessary if the `composer update` fails with an out of memory error
4. `composer update` - this is only necessary if any new composer dependencies were added to `composer.json`
5. Restart any services you stopped previously.
6. `php artisan migrate` - Run any new migrations. Again, only necessary if there were any new migrations in this deployment.
7. Check permissions.  Everything should be read-write by www-data group and `apps/storage/*` should be owned by www-data:www-data.  From your project root, run  
	`chown -R :www-data * `
	`chown -R wwww-data:www-data /apps/storage`

Additional Steps for a fresh clone from a repository
==============================================

1. Configure your `app/config/<environment>` directory with any environment specific configuration settings, for instance the debug flag or to use a local sqlite databse.
2. Create a .env.<environment>.php file in the project root for any configuration settings set by PHP super-global variables. You can find these by `grep ENV app/config/*.php`
3. Configure your environment in the Detect The Application Environment section of `bootstrap.start.php`
4. Run any migrations using `php artisan migrate` If you are using a MySQL database, you must create the database first. Sqlite will automagically create the database file.
