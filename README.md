# Isalud

# Instalación

Descargar y Levantar el contenedor de Docker
`````
make start
`````

Instalar las dependencias del proyecto
`````
make composer-install
`````

Arrancar el proyecto symfony
`````
make run
`````

Para ejecutar el comando 

hay que poner el nombre del fichero obligatorio y el xml es opcional 
`````
make ssh-be
`````
`````
php bin/console app:generate-portfolio filename data/data.xml
`````


