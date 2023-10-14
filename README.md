# PASOS GENERALES A SEGUIR 

### 1) Hacer los modelos `php artisan make:model $Nombre` 
#### se hicieron los modelos Buyer y Seller que extienden de **User**
#### se hizo el podelo Product, Transaction y Category `php artisan make:model $Nombre -m` 

## migraciones 
- Las migraciones nos sirven para establecer estructuras al interior de una base de datos en lo que basicamente son los atributos de tal modelo 
- **IMPORTANTE** el órden en lo que se crea importa

### 2) Se hacen los controladores `php artisan make:controller $carpteta/$nompre . controller -r`
## controladores
- Los controladores de tipo recurso son para añadir controlar los modelos o sea que puedan hacer CRUD