### How to run this image

- currently this image must be build locally.(in future can be pulled from docker hub)
- create folder to mount inside docker container
  - `mkdir -p ./data/mariadb ./data/app/config ./data/app/saved_qrcode`
- Run and build this image as host machine user
  - `PUID="$(id -u)" PGID="$(id -g)" docker-compose up --build -d`
- Run and build this image as specific user
  - `PUID="1000" PGID="1000" docker-compose up --build -d`
- Run app installation <IP>:8080/install
  - Provide Database credentials
- Default login: <IP>:8080
  - user: superadmin
  - password: superadmin

### Roadmap

- Make install process run via docker-compose.
  - Work is partially done. docker-entrypoint.sh is created.(currently disabled due to next steps are pending)
  - qrcode/install/database.php should be adjusted to create database without form submission.
- Make it possible to set PUID and GUID, from environment variable in docker-compose.yml .
- Reduce image size by removing unnecessary dependencies.
- Automate Build image and push to docker hub.
- Audit security flaws and fix it if needed.

### Some debug commands

- `docker-compose logs`
- `PUID="$(id -u)" PGID="$(id -g)" docker-compose config`
- `ps -aef | grep apache2`