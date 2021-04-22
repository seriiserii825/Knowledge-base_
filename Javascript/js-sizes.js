window.pageYOffset - скролл сверху страницы(расстояние от курсора скроллбара до верхней границы окна)
document.documentElement.clientY - Сколько контента видно сверху страницы(высота экрана, который видет пользователь)
document.documentElement.scrollHeight - Высота документа

if((window.pageYOffset + document.documentElement.clientY) >= document.documentElement.scrollHeight){
  
}
