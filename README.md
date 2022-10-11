### Web-application realizes REST API with JSON request/response data format
Web-app is like to do list. There are able to create new task, edit, delete, see all.

#### Vocation
<<<<<<< HEAD
Build web-app without the framework, learn PHP, OOP deeper.
=======
Build web-app without the framework, learn PHP, OOP, SOLID deeper.
>>>>>>> origin/router_sets_route

#### Description
Web-app uses MVC pattern, and it is extensible. There are able to add other controllers, models, routes.
The main thing is that the names match the desired resource in the URI. If URI consists name of the resourse
task - app will look for TasksController and model named Task. Application determines witch controller and
method of controller to run based on request HTTP type and the settings in config file Routes.php. Application throws
the exceptions and handles it. ORM is not used, models communicate with the DB.

#### How to run

* Clone the repository (use branch: router_sets_route)
* ```angular2html docker-compose up -d```
* ```angular2html docker exec -it 58_mysql_1 /bin/sh```
* ```angular2html mysql -u root -p ``` password is: secret
* ```angular2html use mysql;```
* Run SQL queries:
```sql
create table types (
id int not null auto_increment,
name varchar(255) not null,
PRIMARY KEY (id)
)default character set utf8;

insert into types (name) values ('Особисті');
insert into types (name) values ('Робочі');

create table tasks(
id int not null auto_increment,
description text not null,
file varchar(255) not null,
finish_date date not null,
urgently bool default false,
type_id int,
PRIMARY KEY(id),
FOREIGN KEY (type_id) references types(id)
ON DELETE SET NULL

) default character set utf8;

insert into tasks ( description, file, finish_date, urgently, type_id)
values (
'Намалювати інтерфейс цієї программи',
'4.png',
'2022-10-03',
true,
1
);
```
##### Watching all the tasks:
```http request
GET http://localhost/api/tasks
```
##### Store new:
```http request
POST http://localhost/api/tasks
Content-Type: application/json
Accept: application/json

{
    "description": "Опис завдання",
    "file": "Ім'я файлу",
    "finishDate": "2022-10-04",
    "urgently": true,
    "type": "Особисті"
}

```
* File name is the name of the file with its extension. (File sending is not implemented)
* Urgently is an indicator of urgency, if true, then it is urgent, if false, then it is not urgent.
* Type accepts either the term "Особисті" or the term "Робочі"

##### To view task data by its id for further editing (in another request), (here replace the words id with a number)
##### send GET to
```http request
http://localhost/api/tasks/id/edit
```
##### For editing, the request can be as follows (replace the words id with a number):
````http request
PATCH http://localhost/api/tasks/id
Content-Type: application/json
Accept: application/json

{
    "file": "40.png",
    "description": "Намалювати інтерфейс цієї програми",
    "type": "Робочі",
    "urgently": false
}
````
##### To delete a task, the request should be like this (replace the word id with a number)
```http request
DELETE http://localhost/api/tasks/id
Content-Type: application/json
Accept: application/json
```

