# API

## Files scope
Конфигурации `config/sanctum.php`<br>
Контроллеры: `app/Http/Controllers/Api/`<br>
Ресурсы для вывода данных и объявление Abilities: `app/Http/Resources/`<br>
Запросы и валидация ввода данных: `app/Http/Requests/Api/`<br>
Регистрация Abilities: `app/Providers/JetstreamServiceProvider.php`<br>


## Access / Ability
Abilities разрешают давать доступ только к определенным екшонам контроллера. 
Вывод Abilities  проводится через статический метод `ApiController::apiAbilities(string $type): array`

Проверка Abilities проводится через метод `$this->checkAccess($abilities);` контроллера `ApiController` в екшене.

В каждом ресурсе есть возможность указать список возможностей, которые используются в екшенах через константу `const ABILITIES`.
Каждый ресурс который работает с API наследует клас `BaseResource`. 
В нем уже указана константа `const ABILITIES = ['create', 'read', 'update', 'delete']` по умолчанию.

Для регистрации `const ABILITIES` каждого ресурса необходимо объявить список Abilities в `JetstreamServiceProvider::configurePermissions()`

## Search and search mode

##Parameters
Фильтрация в API работает через параметры которые указаны в ресурсе к которому обращается. 
Ресурсы к которым мы можем обращаться хранятся в `app/Http/Resorces`. 
Мы можем указать параметры по которым проводить фильтрацию в константе ресурса `ExampleResource::ATTR_PARAMETERS`; 
Если его не существует, фильрация для конкретного ресурса будет недоступна.

С указанным параметром есть возможность проводить фильтрацию разными способами:
* Полное совпадение (эквивалентно `param = val`): <br>`https://nuxcore-project.com/api/products?price=125`
* Поиск по множеству (эквивалентно `param IN (val1, val2, val3)`): <br>`https://nuxcore-project.com/api/products?price[]=125&price=345&price[]=555`
* К большему (эквивалентно `param > val`): <br>`https://nuxcore-project.com/api/products?price_min=125`
* К меньшему (эквивалентно `param < val`): <br>`https://nuxcore-project.com/api/products?price_max=125`
* В диапазоне (эквивалентно `param < val1 AND param > val2`):  <br>`https://nuxcore-project.com/api/products?price_min=100&price_max=425`

Обратите внимание что для диапазонных значений к параметру добавляется окончание `_min` или `_max`

##Pagination
Пагинация очень важный элемент для оптимизации вывода данных приложения. Пагинация работает с двумя параметрами:
* `offset` - указывает количество элементов ресурса которое необходимо пропустить;
* `limit` - указывает количество элементов ресурса для вывода;

Параметр максимального количества вывода элементов ресурса пагинации указываются в файле конфигураций `config/sanctum.php` и вызываются по ключу `config('sanctum.settings.limit')`.
Пример вывода данных с пагинацией: <br>`https://nuxcore-project.com/api/products?offset=10&limit=100`

##Sort
Сортировка необходима для отображения правильной последовательности данных, 
типы сортировки указываются в файлах конфигураций `config/sanctum.php` и вызываются по ключу `config('sanctum.settings.sort')`.
Ключ значения указывает название сортировки через API, значение **первого** елемента масива указывает колонку в базе данных модели, а **вторая** должна иметь значение `asc` или `desc`. В API сортировка указывается через ключ `sort`.
Пример вывода данных с сортировкой по убыванию цены: <br>`https://nuxcore-project.com/api/products?sort=-price`
