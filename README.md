Hello!

There is a HTML doc of my plans from draw.io in the root folder, called cinema_dev_diagrams(3).html

<img width="4511" height="3381" alt="cinema_dev_diagrams drawio" src="https://github.com/user-attachments/assets/f04c0c41-7866-4758-88dc-c6aa4f702138" /> 

1. SET UP
   
I attempted a dockerized LAMP stack, running containers for angular, phpMyadmin, and mysql.

create-project.sh is what i made to do the defualt prject set up.

I am not familiar with docker on windows, nor writing set up scrips, docker-compose and dockerfiles.

it was a LOT of learning, and a lot of reading.

use of GPT in docker-compose

to run the project,check out the entire thing, go to cinema_booking_dev_project 

run docker compose up --build.

you may need windows and docker windows, personally i dont know how compatible this is for a non-windows system.


once thats done, go to localhost:8081, log into PHPmyAdmin with 
 cinema_user
 cinema_pass

you can then do either:
run the sql in db sql.txt for schema, and then sql data import.txt for dat
or
see exactly what i was using and import cinema_db.sql

GPT used to populate tables. 

grand! now, symfony is just the backend, so localhost:8080 has a page, but localhost:8080 is really just where the backend can be reached.
i didnt hide the page because its a dev set up, definitely not production ready.

the angular site is available on http://localhost:4200

the angular app and symfony app are set up so i can hotload it, you'll see the volumes in docker-compose if you look.
i tried to have it load all my dependancies but i very quickly ran out of time and patience.



2. PROJECT BREAK DOWN

 better presentation cleaned up git, cleaned up backend, cleaned up frontend
 its better, still no JWT.

cheers & have a good one!





