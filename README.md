### Web-application realizes REST API with JSON request/response data format
Web-app is like to do list. There are able to create new task, edit, delete, see all.

#### Vocation
Build web-app without the framework, learn PHP, OOP, SOLID deeper.

#### Description
Web-app uses MVC pattern, and it is extensible. There are able to add other controllers, models, routes.
The main thing is that the names match the desired resource in the URI. If URI consists name of the resourse
task - app will look for TasksController and model named Task. Application determines witch controller and
method of controller to run based on request HTTP type and the settings in config file Routes.php. Application throws
the exceptions and handles it. ORM is not used, models communicate with the DB.
See branch https://github.com/A-Khranovsky/praction-manual-rest-api-mvc/tree/router_sets_route
