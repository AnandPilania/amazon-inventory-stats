This application can be use as a Boilerplate or a Base for the MWS related SaaS applications.


###Features

This application will handle any number of regions.
Any of number of marketplaces can be integrated.
MWS request throtlling is already taken care of for various APIs.


From the settings user can add the marketplace.


There are three artisan commands are created.

``php artisan mws:report``   That can be run daily for getting data.

``php artisan mws:reportfetch``  That can be used to fetch the reports which takes too much time to load the data. (This command is just to be created just to be cautios so we dont loose any data)

``php artisan mws:pastdata`` this command can be used to fetch the data for certain start date and end data.

For the setting up the application run ``php artisan migrate`` also run `php artisan db:seed`


While fetching the data if the orders does not exist in database. it will insert the data or it will update the orders.
