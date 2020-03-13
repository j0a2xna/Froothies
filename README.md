froothies.com 

*** all requests are done through rabbitmq
    .ini files:
            testRabbitMQ.ibi
            recipe.ini
            account.ini
            AMD_Server.ini
            RMQ_Server.ini
            recommend.ini

  frontend: php/html hosted on apache
    front page: 
                index.php, login and authentication, redirects to welcome page
                register.php, registeration, redirects to login

                welcome.php, user dashboard, links to user account page and recipe maker
                            user ratings.php, and comments.php, search bar
                
                myaccount.php, requests users data from localdb

                recipe.php, creates user smoothie recipe, adds to users data
                
                search.php, searches for ingredients and recipes
                
                recommendSmoothie.php, requests smoothies data from localdb
    
  backend: php hosted on mariadb
                mysqlserver.php, connects to localdb, authenticates login and creates table for new users

                myaccountserver.php, pulls users data from my account request

                makesmoothie.php, takes users recipe and adds to localdb and users data

                mdserver.php, dmz_server.php, takes search request and checks local db if not available requests from dmz_server, adds to local db and returns data to frontend
                
                recommendSmoothieServer.php, pulls random smoothie data


How do I run this?
<ul>
<li>./mysqlserver.php -> log in, register</li>
<li>./myaccountserver.php -> my account</li>
<li>./makesmoothie.php -> create a smoothie form in the welcome page</li>
<li>./recommendSmoothieServer.php -> smoothie of the day from the welcome page</li>
<li>./search.php -> search.php, dmz_server.php, loginDB.php, md_cred.php, md_server.php</li>
</ul>




Contact Email: jy353@njit.edu
trello: https://trello.com/b/y4qIl03S/it-490system-integration


