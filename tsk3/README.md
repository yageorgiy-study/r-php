# Task

## Setup

```bash
# ...
php artisan migrate:fresh --seed 
# ...
```

## Management

### Create regular user

```bash
php artisan app:make-user

# Password?:
# > 12345
#
# Email?:
# > user@test.test
#
# Name?:
# > Test User

```

### Create admin user

```bash
php artisan app:make-admin

# Password?:
# > 12345
#
# Email?:
# > test@test.test
#
# Name?:
# > Test Admin

```
