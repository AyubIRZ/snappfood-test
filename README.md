## Installation instructions

### Prerequisites:
1. This project needs a working setup of Docker.
2. This project needs a working setup of Docker-compose.

### Step 1:
First, you should navigate to the "docker" directory.

### Step 2:
To have the project working correctly, you should change the project's main ".env" file, located in the "docker" 
directory as you wish.

### Step 3:
Open up a terminal and run the following command to spin up the complete stack:

```bash
$ docker-compose up --build
```

### Step 4:
Install application dependencies using the following command:

```bash
$ docker-compose exec app composer install
```

### Step 5:
To test te project functionality and also run tests, you need to seed the DB with fake data using
the following command:

```bash
$ docker-compose exec app php artisan migrate:fresh --seed
```

### Step 6:
Use postman or any Http / API client to test the functionality of the project. A postman collection is attached to be
 used.


### Step 7:
To run tests, use the following command:

```bash
$ docker-compose exec app vendor/bin/phpunit
OR
$ docker-compose exec app php artisan test
```

## Considerations
- It's clear that the test cases and test suits are not covering everything. The reason for that was the lack of time and to respect the deadline.
- There is no API visioning, to keep the structure simple.
- No relation join was used because of performance.
- The Employee management feature is just to show the feature and is as simple as showing an employee by its ID. This is for 
simplicity and showing the test.