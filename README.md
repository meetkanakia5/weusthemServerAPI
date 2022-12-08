Download xampp
make 2 database in xampp :- practice and weusthem
Install composer for php laravel
install postman - (If you only want to run API)

Run Both of this project simultaneously, else project won't work

1 Project
-------------
Download / pull in : Run this commands in " CMD " .
    -> git clone https://github.com/meetkanakia5/weusthemServerAPI.git
    -> composer install
    -> php artisan key:generate
    -> php artisan migrate
    -> Run php artisan serve

This project will run on different port number, so I have mentioned that command at very end.
2 Project
----------------
Download / pull in : Run this commands in " CMD " .
    -> git clone https://github.com/meetkanakia5/weusthemUIAccessAPI.git
    -> composer install
    -> php artisan key:generate
    -> php artisan migrate
    -> Run php artisan serve --port=8001


Go to Web Browser
    -> http://localhost:8001/getContact 
    -> After this page start adding the data
    -> Note:- (Image upload won't work on the web browseer. It will will work with postman, so if ou wanna check image uploading then try from postman)
    -> If you want to work only with post man then, please go through this routes and add the data accordingly
        -> Get all the data :- (localhost:8000/api/contacts/)
        -> Add Data :- (localhost:8000/api/contacts/)
        -> Edit specific data, please enter the id: (localhost:8000/api/contacts/$id/edit)
        -> update the specific data :- (localhost:8000/api/contacts/$id)
        -> delete data:- (localhost:8000/api/contacts/id)
