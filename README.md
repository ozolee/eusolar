# EU Solar - REST API

##**Telepítés**

- git repository klónozása
- restapi > db_dump > ```eusolar.sql``` fájl bedumpolása
- ```.env``` fájl beállításai ```.env.example``` fájl szerint
- terminálban ```restapi``` mappába belépni
- ```php artisan serve``` parancs futtatása után hívhatóak a végpontok
```
GET - http://127.0.0.1:8000/api/inverters
GET - http://127.0.0.1:8000/api/panels
POST - http://127.0.0.1:8000/api/quote

(postmanből ezeken az url-eken értem el a végpontokat)
```


