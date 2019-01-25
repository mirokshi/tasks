PATH 
````
/etc/supervisor/conf.d/tasks.mirokshi.scool.cat.conf
````
Contenido : 

*LOCAL*

````
[program:laravel-worker-tasks-mirokshi-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/mirokshi/code/mirokshi/tasks/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=mirokshi
numprocs=8
redirect_stderr=true
stdout_logfile=/home/mirokshi/code/mirokshi/tasks/storage/logs/worker.log
````

*PRODUCTION*

````
[program:laravel-worker-tasks-mirokshi-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/mirokshi/code/mirokshi/tasks/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=forge
numprocs=8
redirect_stderr=true
stdout_logfile=/home/forge/app.com/worker.log
````
