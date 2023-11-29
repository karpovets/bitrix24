**1) через стандартный внутренний сервис, доступный в BX.ajax.runAction('<описание  сервиса>.getUserNameVowels')**

BX.ajax.runAction('test:app.userapi.User.getUserNameVowels', {
data: {id: userId}
}).then(function (response) {
console.log(response);
}, function (response) {
console.log(response.errors);
});


**2) модуль должен возвращать результат данного метода:**

   -через REST endpoint вида <domain>/rest/<id>/<token>/get.username.vowels

get.username.vowels.json
Запрос:
{
"id": 9874
}