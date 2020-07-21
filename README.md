## Binary Studio Academy

Ваша задача протестировать работу сервиса аналитики данных финансового рынка.

### Unit Testing (5 баллов)

Метод [`MarketDataService::getChartData`](app/Services/MarketDataService.php) принимает на вход начальную и конечную даты данных и частоту детализации, с которой эти данные будут отображены на графике.

```php
/**
 * @param \DateTime $startDate - начальная дата для графика
 * @param \DateTime $endDate - конечная дата для графика
 * @param int $frequency - частота данных в секундах
 *
 * @return ChartDataCollection 
 */
getChartData(\DateTime $startDate, \DateTime $endDate, int $frequency): ChartDataCollection
```

Задача этого метода выбрать данные из репозитория [StockRepository](app/Repositories/StockRepository.php) в диапазоне от $startDate до $endDate включительно и сгруппировать их с частотой $frequency. Данные группируются, как среднее арифметическое цены за период одного деления, т.е. если частота 1 день, то каждый день будет среднее арифметическое всех данных за день.

Ваша задача написать unit-тесты в файле [Tests\Unit\MarketServiceTest](tests/Unit/MarketServiceTest.php) для проверки работы метода `getChartData`.

Вам следует проверить следующие тест-кейсы:

1) метод группирует данные корректно по часам, дням, неделям

2) метод работает корректно, если за выбранный период данных нет

3) метод выбрасывает исключение [`InvalidFrequencyException`](app/Services/Exceptions/InvalidFrequencyException.php), если частота отрицательная или равна 0

При этом, вам следует учесть, что не должно быть никаких операций с базой данных.

### Functional testing (5 баллов)

Есть API для работы с биржей.

Добавление акций:

```
POST /api/stocks
Content-type: application/json
Request body:
{
	"price": <number>
	"start_date": <date-time> // format YYYY-MM-DD HH-MM-SS, e.g 2020-07-01 09:30:15
}

Status code: 201
Response:
{
	"data": {
		"id": <number>,
		"price": <number>,
		"start_date": <date-time>
	}
}
```

Удаление акций:

```
DELETE /api/stocks/{id}
Content-type: application/json
Status code: 204
```

Получение аналитических данных за период:

```
GET /api/chart-data
Parameters:
	start_date=<timestamp in seconds>
	end_date=<timestamp in seconds>
	frequency=<integer>
Content-type: application/json
Status-code: 200

{
	"data": [
		{
			"date": "date-time",
			"price": "number"
		},
		...
	]
}
```

Ответ в случае логической ошибки:

```
Status code: 400
{
	"message": <string>
}
```

API должно соответствовать следуюшим требованиям:

- Добавлять и удалять акции могут только зарегистрированные и аутентифицированные пользователи.

- Пользователь может удалять только свои акции.

- Цена не может быть отрицательной.

- Акции нельзя добавлять за прошлую дату.

- Аналитические данные может получить любой желающий пользователь, независимо от регистрации.

- Начальная дата для аналитических данных не должна превышать конечную.

- Отрицательный параметр $frequency должен возвращать логическую ошибку корректно. 

Ваша задача написать API тесты в файле [Tests\Feature\MarketApiTest](tests/Feature/MarketApiTest.php) согласно требованиям и исправить несоответствия.

В этом задании, ожидается, что вы будете проверять состояние базы данных.

### Запуск

```bash
cp .env.example .env

docker-compose up -d

docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate

docker-compose exec app ./vendor/bin/phpunit
```

### Проверка

Вам необходимо склонировать этот репозиторий, выполнить задание, запушить на bitbucket и прислать ссылку на репозиторий в личном кабинете.

__Форкать репозиторий запрещено!__

1) Unit-testing (5 баллов):

- Все предложенные тест-кейсы выполнены

- Операции с базой данных не проводятся

2) Feature testing (5 баллов)

- Работа API проверяется согласно описанным требованиям

- Исправлены все недочеты API

Feel free добавлять тест-кейсы не описанные в задании, это будет считаться за плюс.
