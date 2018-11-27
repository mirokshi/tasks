##Comandos utiles 
- npm run dev
- npm run watch 
- npm run hot 



##Cosas por hacer
- Al archivo TAREAS.md

##Valet
- valet link -> añadir otro proyecto
- valet path -> Las rutas 
- valet secure -> hacer segura la pagina https://

## 
- CRUD -> CRU -> CREATE RETRIEVE UPDATE DELETE
- BREAD -> PA -> BROWSER READ EDIT ADD DELETE
- HTTP -> GET || POST || PUT || PATCH ||DELETE
  
## Branch's
 
 Crear branca 
 
 ```
  git 
  ```
 
 Cambio de brancas
 
 ```
 git checkout NOM_BRANCA
 ```  
 
## Actualizar produccion
 
 **NOTA/IMPORTANTE** : Apagar nom run hot
 
 Procedimiento
 
 ```
   co
   git checkout production
   git merge master
   co ( git status -> limpio ) 
   git checkout master
   git push --all origin
    
   ```
 
 ## Toublehoosting. Resolucion de problemas  
 
 Conflicto si git merge avisa de conflicto
 
 - Opcion 1
 
 ```
  git status  -> Y leer:
  git checkout -- public/mix-manifest.json //Antes apagar npm run hot 
  git status -> limpio
  git merge 
  ```
 
 - Opcion 2
 
   Resolver el conflicto con PHPStorm  
   
   Despues ejecutar los comandos
  
  ## Instalaciones
   
  **Impersonate**
  https://github.com/404labfr/laravel-impersonate#configuration
composer require lab404/laravel-impersonate
php artisan vendor:publish --tag=impersonate

  **Passport**
  https://laravel.com/docs/5.7/passport#installation
composer require laravel/passport
php artisan migrate
php artisan passport:install

**Permission**
    https://github.com/spatie/laravel-permission


**
PHP implode
http://php.net/manual/es/function.implode.php

**flash of unstyled content**
``v-cloak``
