## Events API
Made with PHP and SQL Data base
# Purpose
To act as a backend for a Scheduling VUEJS Project
to display the events on calendar 

# Instalation
Download and install composer
[LINK](https://getcomposer.org/)

Create Database and connect it in 
```
src/config/db.php
```

Install SlimPHP
```
composer require slim/slim:3.*
```

# Endpoints
```
GET /api/customers
GET /api/customer/{id}
POST /api/customer/add
PUT /api/customer/update/{id}
DELETE /api/customer/delete/{id}
```

# Database Table
```
id,
title,
start,
end,
color
```