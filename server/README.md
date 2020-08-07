## Backend Jalimbing App
## Framework Laravel 7.0

### Requirement
 * `PHP 7.4>`
 * `NGINX/Apache (if you run on localhost, just use php artisan serve on console)`
 * `Mysql`
 * `composer`

### Setup
* `duplicate .env-example and rename to .env`
* `Insert Identity Database`
* `composer install`
* `php artisan key:generate`
* `php artisan migrate --seed`
* `php artisan storage:link`

### Features
- \[x] System Login Admin
- \[x] CRUD Role and Admin
- \[ ] Unit Testing
- \[x] CRUD maps
- \[x] API for Mobile
- \[x] Project / DB Setup in Ubuntu - Docs
- \[ ] Security API
- \[ ] Hosting

### Endpoint API
| `Route` | Method |
| -------------------------------------------- | ---------------------------- |
| `http://localhost:8000/api`                  | `GET`                        |
| `http://localhost:8000/api/home`             | `GET`                        |
| `http://localhost:8000/api/[id]/show`        | `GET`                        |
| `http://localhost:8000/api/maps`             | `GET`                        |


### Email and Passwords
 * `superadmin@admin.com / Superadmin_1 (role:superadmin)`
 * `ikada@gmail.com / ikada_1 (role:admin)`

### Image
![ikada_login_admin](https://user-images.githubusercontent.com/38114768/89608230-c6cd5800-d89e-11ea-85ad-d2529797c1d6.png)
![admin_dashboard](https://user-images.githubusercontent.com/38114768/89608249-d2208380-d89e-11ea-85f7-692cf6d52673.png)
![ikada_category](https://user-images.githubusercontent.com/38114768/89608263-db115500-d89e-11ea-8b53-5ec1f3e3d5cf.png)
![ikada_maps](https://user-images.githubusercontent.com/38114768/89608277-e5cbea00-d89e-11ea-90c7-19b7ec845038.png)

## Author

[Claytten]('https://github.com/claytten/jalimbing_app')
