## Запрос всех ящиков
#### Resourse URL

GET /ui/api/v1/ajax/mail/mailboxes

#### Пример ответа JSON

```
{
  items:[
    0:{
      'id':26,
      'email':'skoryukin@team.amocrm.ru',
      'active':true,
    },
    1:{
      'id':27,
      'email':'mail@mail.ru',
      'active':true,
    },
  ]
}
```

## Настройки ящика
На странице настроек есть возможность отредактировать данные уже существующего ящика и создать новый ящик. При редактировании отправляется запрос с целью получения существующих настроек.

#### Resourse URL

GET /ui/api/v1/ajax/mail/mailboxes/{id} (запрос для существующего ящика)

#### Пример ответа JSON

```
{
  'id':26
  'email':'skoryukin@team.amocrm.ru',
  'active':true,
  'setting':{
    'imap':{
      'server':'imap.yandex.ru',
      'port':993,
      'ssl':true,
    },
}
```

### Поиск настроек сервера
После того как будет отредактирован адрес почтового ящика и поле ввода адреса потеряет фокус, будет сгенерировано событие потери фокуса. Следом отправится запрос на настройки для сервера, которому принадлежит этот адрес.

#### Resourse URL
GET /ui/api/v1/ajax/mail/settings

#### Данные на запроса JSON
```
{
  'email':'mail@vk.com'
}
```
#### Пример ответа JSON
```
# если нашли настройки
{
  'email':'mail@vk.com'
  'setting':{
    'imap':{
      'server':'imap.yandex.ru',
      'port':993,
      'ssl':true,
    },
}

# если нет данных в таблице (или другим образом не нашли настройки)
response: {}
```
### Сохранение данных
После заполнения всех полей отправляется запрос на сохранение данных. Скрипт осуществляет валидацию введенных данных и пытается авторизоваться на сервере. В случае успешной авторизации обновляются значения в таблице для уже существующего контакта, либо добавляются новые для только что созданного.

#### Примечание
Необходимо продумать коды ошибок.

#### Resourse URL
POST /ui/api/v1/ajax/mail/mailboxes(при сохранении нового ящика)

POST /ui/api/v1/ajax/mail/mailboxes/{id} (при запросе для существующего ящика)

#### Данные для запроса JSON
```
{
  'email':'mail@vk.com',
  'password':'111111',
  'active':true,
  'setting':{
    'imap':{
      'server':'imap.yandex.ru',
      'port':993,
      'ssl':true,
    },
}

```
#### Пример ответа JSON
```
# если отредактировали данные для ящика
{
  'response':'success'
}

# если создали новый ящик
{
  'id':517,
  'email':'mail@vk.com',
  'active':true,
}

# возникла ошибка
{
  'errors':{
    'email':'invalid',
    'password':'not_exist',
    'setting':{
      'imap':{
        'server':'empty',
        'port':'invalid',
      }
    }
  }
}
```
#### Список ошибок PHP
```
$errors = [];

$errors['email'] = 'invalid';// не корректно введен адрес почтового ящика
$errors['email'] = 'empty';// не заполнено поле email
$errors['email'] = 'not_exist';// отсутствует поле email

$errors['password'] = 'empty';// не заполнено поле password
$errors['password'] = 'not_exist';// отсутствует поле password

$errors['active'] = 'empty';// не заполнено поле active
$errors['active'] = 'invalid';// значение поля active должно быть булевым
$errors['active'] = 'not_exist';// отсутствует поле active

$errors['setting']['imap']['server'] = 'invalid';// не корректно введен адрес imap-сервера
$errors['setting']['imap']['server'] = 'empty';// не заполнено поле server
$errors['setting']['imap']['server'] = 'not_exist';// отсутствует поле server

$errors['setting']['imap']['port'] = 'empty';// не заполнено поле port
$errors['setting']['imap']['port'] = 'invalid';// не корректно введен порт imap-сервера
$errors['setting']['imap']['port'] = 'not_exist';// отсутствует поле port

$errors['setting']['imap']['ssl'] = 'empty';// не заполнено поле ssl
$errors['setting']['imap']['ssl'] = 'invalid';// значение порта imap-сервера должно быть булевым
$errors['setting']['imap']['ssl'] = 'not_exist';// отсутствует поле ssl

```