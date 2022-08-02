# Fridge-Master
Fridge Master API

### Installation
1. git clone https://github.com/ozadorozhnyi/Fridge-Master.git
2. cd Fridge-Master
3. cp .env.example .env
4. edit .env 
   1. set your own db-connection credentials
   2. change CACHE_DRIVER=file on to CACHE_DRIVER=redis
6. composer install
7. php artisan key:generate
8. php artisan migrate:fresh --seed
9. php artisan serve
10. 
