### Web-application realizes REST API with JSON request/response data format
Web-app is like to do list. There are able to create new task, edit, delete, see all.

#### Vocation
Build web-app without the framework, learn PHP, OOP deeper.

#### Description
Web-app uses MVC pattern, and it is extensible. There are able to add other controllers, models, routes.
The main thing is that the names match the desired resource in the URI. If URI consists name of the resourse
task - app will look for TasksController and model named Task. Application determines witch controller and
method of controller to run based on request HTTP type and the settings in config file Routes.php. Application throws
the exceptions and handles it. ORM is not used, models communicate with the DB.

#### How to run

* Clone the repository (use branch: router_sets_route)
* ```docker-compose up -d```
* ```docker exec -it 58_mysql_1 /bin/sh```
* ```mysql -u root -p ``` password is: secret
* ```use mydb;```
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
##### Watching all the tasks with filter by file name:
```http request
GET http://localhost/api/tasks?file=12.png
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
#### Some examples
```http request
GET http://localhost:80/api/tasks

HTTP/1.1 200 OK
Date: Wed, 12 Oct 2022 12:57:09 GMT
Server: Apache/2.4.52 (Debian)
X-Powered-By: PHP/8.1.2
Content-Length: 496
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Content-Type: application/json; charset=utf-8

[
  [
    {
      "id": 2,
      "description": "Намалювати інтерфейс цієї програми",
      "file": "40.png",
      "finish_date": "2022-10-04",
      "urgently": 0,
      "type": "Робочі"
    },
    {
      "id": 4,
      "description": "Поїсти",
      "file": "12.png",
      "finish_date": "2022-10-04",
      "urgently": 1,
      "type": "Особисті"
    }
  ]
]

Response code: 200 (OK); Time: 203ms; Content length: 241 bytes
```
```http request
GET http://localhost:80/api/tasks/2/edit

HTTP/1.1 200 OK
Date: Wed, 12 Oct 2022 12:58:18 GMT
Server: Apache/2.4.52 (Debian)
X-Powered-By: PHP/8.1.2
Content-Length: 284
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Content-Type: application/json; charset=utf-8

[
  {
    "id": 2,
    "description": "Намалювати інтерфейс цієї програми",
    "file": "40.png",
    "finish_date": "2022-10-04",
    "urgently": 0,
    "type_id": 2
  }
]

Response code: 200 (OK); Time: 178ms; Content length: 129 bytes
```
```http request
DELETE http://localhost/api/tasks/2

HTTP/1.1 201 Created
Date: Wed, 12 Oct 2022 12:58:58 GMT
Server: Apache/2.4.52 (Debian)
X-Powered-By: PHP/8.1.2
Content-Length: 0
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Content-Type: application/json; charset=utf-8

<Response body is empty>

Response code: 201 (Created); Time: 170ms; Content length: 0 bytes
```
