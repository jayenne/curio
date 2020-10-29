# Servers

---
- [Servers](#server)
- [Daemons](#daemons)
- [Database](#database)
- [Search](#search)

<a name="server"></a>
## Spin up the server
Open terminal
```bash
cd homestead
vagrant up
vagrant ssh
cd code/project.name
```
---

<a name="supervisor / daemons"></a>
## Supervisor
Supervisor monitors that the server daemons are all working as expected. On booting a server Supervisor will start the daemons as per the config file found in `/etc/supervisor/conf.d/dingo.conf`
Currently we start Horizon, Queues and the Twitter listener.
>{info}If you edit /etc/supervisor/dingo.conf then you must run the following commands for the changes to take effect.
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start all
```
>{info}Supervisor will create a number of logs in the `/storage/logs/` directory with a 'supervisor.' prefix
### Optionally, you may start the service via the Artisan CLI

#### Start the Queue
`php artisan queue:work --tries 1`

#### Start Laravel Horizon
`php artisan horizon`

#### Start watching Twiter for mentions
`php artisan twitter:listen-for-mentions`

> {warning} If the twitter auth fails then the server clock is probably out of sync.
> In which case either close terminal then restart all daemons 
> or resync servers... sudo systemctl restart systemd-timesyncd.service

---
<a name="database"></a>
## Database
To refresh the dtata base you sould use `php artisan migrate:fresh`
If you wish to seed it then, instead, use `php artisan migrate:fresh --seed`
>Once you have refresh the data basee you must now reinstall telescope and horizon...
`php artisan telescope:install` and `php artisan horizon:install`

<a name="search"></a>

## Search (Algolia)
To flush the Algolia database use `php artisan scout:flush`

To import a model in to the search datsabase use `php artisan scout:import`

To Sync search database with algolia use `php artisan scout:sync`
