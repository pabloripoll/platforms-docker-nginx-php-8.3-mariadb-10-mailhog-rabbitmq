<div id="top-header" style="with:100%;height:auto;text-align:right;"></div>

# NGINX + PHP 8.3

- [./back](../../README.md)
- [Container Configuration](#container)
- [Container Management](#management)
<br>

## <a id="container"></a>Container Configuration

### Containers Access Modes

- If no application is on `./apirest` directory *(or your custom binded directory name)* once container is up it wont provide a application and therefore NGINX will respond with an error. Copy an start-up example application or create a parking page.
- Set the required environment values in `./docker/.env` from `./docker/.env.example` if no GNU Make will be applied.
- Set the required configuration files by coping and updating them depending on your project requirements.
- Container availability by building the container with `docker-composer.yml` in separated configuration layers
    - Stand-alone
        - The container is intended to be published directly and accessed from the host network, typically via `0.0.0.0:<port>`. It does not require a shared Docker network. It is a common setting for local development.
    - Inside a Custom Network
        - The container is attached to a custom Docker network and is intended to be accessed through a reverse proxy or other containers on the same network. This is useful for isolating services while still allowing container-to-container communication. It is a recommended setting for remote deployment.
    - Host-Gateway
        - The container can reach services running on the host machine using the Docker host gateway mapping. This is useful when the container must access local services on the VPS/host, while public access is still handled through a reverse proxy. It is a recommended setting for remote deployment too.
    - Public exposure is controlled by the `ports` mapping.
    - `0.0.0.0:<port>` means externally accessible.
    - `127.0.0.1:<port>` means local-only access on the host and requires a reverse proxy, e.g. NGINX.
    - Docker network attachment controls container-to-container communication.
    - Host-gateway controls container-to-host communication.
<br><br>

### Dockerfile

You might be using this repository with different databases connection. Copy from sample and set the correct packages and modules required by commenting them out, and others not required is recommended to be commented. In this way, the container will be built only with the neccessary settings an in less time

- `./docker/Dockerfile.base` -> `./docker/Dockerfile`

### NGINX

The default example is a server block for a REST API, but it can be use for webapps too

- `./docker/config/nginx/conf.d-sample/default.conf` -> `./docker/config/nginx/conf.d/default.conf`

### PHP

These are the default PHP settings. Copy them all with the proper configuration required for your project

- `./docker/config/nginx/conf.d-sample/fpm-pool.conf` -> `./docker/config/nginx/conf.d/fpm-pool.conf`
- `./docker/config/php/conf.d-sample/php.ini` -> `./docker/config/php/conf.d/php.ini`

```bash
# Memory limit
memory_limit = 128M # must be equal or less than container max memory usage
```

To automatically run the PHP application, create the Supervisord service that runs the application. You can choose the dev or production version, and set it according to your project requirements

- `./docker/config/supervisor/conf.d-sample/php-fpm.conf` -> `./docker/config/supervisor/conf.d/php-fpm.conf`

```bash
[program:php-fpm]
command=php-fpm83 -F
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
autostart=true
autorestart=true
startretries=0
```
<br>

## <a id="management"></a>Container Management

To manage the container, run the GNU Make recipes
```bash
$ make help
Usage: $ make [target]
Targets:
$ make help                           shows this Makefile help message
$ make port-check                     shows this project port availability on local machine
$ make env                            checks if docker .env file exists
$ make env-set                        sets docker .env file
$ make info                           shows container information
$ make ssh                            enters the container shell
$ make up                             starts and recreates containers if compose config or image changed, runnning in detached mode
$ make build                          builds and ensures changes in the Dockerfile, build steps, or copied-in files are applied. Not --no-recreate
$ make network                        starts up into an existing custom network for container-to-container communication, runnning in detached mode
$ make host-gateway                   starts up for container-to-host communication, runnning in detached mode
$ make start                          starts the container and put on running from latest configuration
$ make stop                           stops the running container but data will not be destroyed
$ make restart                        restarts the running container
$ make clear                          removes container from Docker running containers
$ make destroy                        delete container image from Docker cache
$ make dev                            sets a development enviroment
$ make supervisord-conf               lists supervisord services set on the running container
$ make supervisord-update             updates supervisord services without the need of stoping or rebuilding the container
$ make nginx-conf                     shows nginx configuration set on the running container
$ make nginx-update                   updates nginx configuration without the need of stoping or rebuilding the container
$ make nginx-default-conf             shows nginx default server block set on the running container
$ make nginx-default-update           updates nginx default server block without the need of stoping or rebuilding the container
$ make php-conf                       shows php configuration set on the running container
$ make php-conf-update                updates php configuration without the need of stoping or rebuilding the container
$ make php-fpm-conf                   shows PHP-FPM configuration set on the running container
$ make php-fpm-update                 updates PHP-FPM configuration without the need of stoping or rebuilding the container
```
<br>

## Contributing

Contributions are very welcome! Please open issues or submit PRs for improvements, new features, or bug fixes.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -am 'feat: Add new feature'`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Create a new Pull Request
<br><br>

## License

This project is open-sourced under the [MIT license](LICENSE).

<!-- FOOTER -->
<br>

---

<br>

- [GO TOP ⮙](#top-header)
