# Server Config

## nginx

To get the app running with nginx, the following server block configuration can be used. 
It doesn't do much more than setting up the core site, no caching, etc is in place.

```
server {
    listen 80 default_server;
    listen [::]:80 default_server ipv6only=on;

    root /path/to/your/deploy/public;
    index index.php index.html index.htm;

    server_name freethegeek.fm www.freethegeek.fm

    location / {
        #try_files $uri $uri/ =404;
        try_files $uri $uri/ /index.php?q=$uri&$args;
    }

    error_page 404 /404.html;
    error_page 500 502 503 504 /50x.html;

    location = /50x.html {
        root /path/to/your/deploy/public;
    }

    # required to migrate from the old rss setup
    location = /rss.xml
    {
        rewrite .* /rss redirect;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## Apache 2.x

TBW

