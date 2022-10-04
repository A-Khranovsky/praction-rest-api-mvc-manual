### Wеb-додаток реалізуючий REST API.
Формат данних, очікуваних сервером та відправляємих клієнту, є JSON.

#### Для перегляду всіх завданнь відправте запит GET до:
```angular2html
http://khranovskiy.softwars.com.ua/api/tasks
```

#### Для перегляду переметрів з яких скаладється завдання для його подальшого створення (в іншому запиті) відправте GET до:
```angular2html
http://khranovskiy.softwars.com.ua/api/tasks/create
```

#### Для Створення нового завдання відправте
```angular2html
POST http://khranovskiy.softwars.com.ua/api/tasks
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
* Ім'я файлу назва файла з його розширенням. (Відправка файла не реалізовано)
* Urgently показник терміновості, якщо true, то терміново, якщо false то не терміново.
* Type приймає чи строку "Особості" чи строку "Робочі"

#### Для перегляду данних завдання по його id для подальшому їх редагуванні (в іншому запиті),(тут заменіть слов id на номер) відправте GET на
```angular2html
http://khranovskiy.softwars.com/api/tasks/id/edit
```  

#### Для редагування запит може бути таким (заменіть слов id на номер):
```angular2html
PATCH http://khranovskiy.softwars.com/api/tasks/id
Content-Type: application/json
Accept: application/json

{
    "file": "40.png",
    "description": "Намалювати інтерфейс цієї програми",
    "type": "Робочі",
    "urgently": false
}
```

#### Для видалення завдання, запит має будти таким (заменіть слов id на номер)
```angular2html
DELETE http://khranovskiy.softwars.com/api/tasks/id
Content-Type: application/json
Accept: application/json
```            
