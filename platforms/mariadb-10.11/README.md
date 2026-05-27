<div id="top-header" style="with:100%;height:auto;text-align:right;"></div>

# MARIA DB 10.11

- [./back](../../README.md)
- [Source](#source)
- [Container Configuration](#container)
- [Container Management](#management)
<br>

## <a id="source"></a>Source

- https://github.com/MariaDB/mariadb-docker
- https://github.com/MariaDB/mariadb-docker/tree/master/10.11
<br><br>

## <a id="container"></a>Container Configuration

Containers Access Modes:
- Set the required environment values in `./docker/.env` from `./docker/.env.example` if no GNU Make will be applied.
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
$ make start                          starts the container and put on running from latest configuration
$ make stop                           stops the running container but data will not be destroyed
$ make restart                        restarts the running container
$ make clear                          removes container from Docker running containers
$ make destroy                        delete container image from Docker cache
$ make dev                            sets a development enviroment
$ make test-up                        creates a side database for tests
$ make test-down                      drops the side database for tests
$ make sql-install                    imports [file-name].sql file into database container as an initial project database located in /[dir-path]/
$ make sql-install-clear              clears up the [file-name].sql file as an initial project database located in /[dir-path]/
$ make sql-replace                    replaces the database container with the located in /[dir-path]/[file-name].sql file
$ make sql-backup                     exports into [file-name].sql file the project database backup into /[dir-path]/
$ make sql-backup-clear               clears up the project database backup [file-name].sql file located in /[dir-path]/
$ make sql-drop                       drops the current database and creates an empty new one inside the container
$ make remote-host-copy               copies referenced remote database by tcp connection into /[dir-path]/[file-name].sql for local development
$ make remote-file-copy               copies referenced remote database file into /[dir-path]/[file-name].sql for local development
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
