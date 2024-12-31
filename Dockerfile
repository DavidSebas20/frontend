# Usamos una imagen base de PHP con Apache
FROM php:8.2-apache

# Habilitar mod_rewrite para permitir URLs limpias (si es necesario)
RUN a2enmod rewrite

# Copiar los archivos del proyecto a la carpeta del servidor web en la imagen Docker
COPY . /var/www/html/

# Establecer permisos adecuados (si es necesario)
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para que el contenedor sea accesible
EXPOSE 80

# Configurar Apache para que sirva el contenido de /var/www/html
CMD ["apache2-foreground"]
