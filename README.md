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

i needed to modify my docker engine as docker was having a lot of outages and i was getting 503s
{

  "builder": {
    "gc": {
      "defaultKeepStorage": "20GB",
      "enabled": true
    }
  },
  "experimental": false,
  "registry-mirrors": [
    "https://mirror.gcr.io"
  ]
}


once thats done, go to localhost:8081, log into PHPmyAdmin with 
PMA_USER: cinema_user
PMA_PASSWORD: cinema_pass

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
   

the backend 

I bit off too much, underestimated the difficulty of symfony, and overestimated my own time.

I worked backend first, generated entities using Doctrine, and moved as fast as i could. there are pointless API endpoints, misplaced methods and things got messy when debugging.

the structure, if adhered to, is pretty good.

several things were written only to be unused, pointless, or wrong.

entity mapping with doctrine was a headache, and im sure i broke some rules.

the controllers need interfaces, symfony dependancy injection is strange, and binding interfaces to concrete services is strange to me.

I spent a good couple hours trying not to just have a util that mapped entities to arrays for serialization but would have had to re-do most of my code to implement serializer(which i did not understand off the bat anyway) i felt very spoiled by java's " implements Serializable" ha!

if i were to re-do it, it would be much cleaner. may do it for fun next week.


the frontend 

5 pages, connected to 1 service for my API calls.

I tried JWT implementation and lost a day, so the user is handled by entity in local storage.

there is no security. the passwords are hashed when stored, otherwise its an open book.

the login works, the sign up works, the booking works, the remove booking didnt in the beginning and i didnt click on it again,this was already late.

the presentation could use a lot of work, it is minimal.

GPT was used to help fix my routing, to help understand what Doctrine annotations to use, for debugging some very shoddy angular code. 

overrall, I attempted something new and challenged myself. 

I would not say i rose to meet the challenge well,

but i learnt many things and enjoyed the process.

cheers & have a good one!





