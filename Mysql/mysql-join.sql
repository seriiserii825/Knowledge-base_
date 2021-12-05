#
Выбираем teacher.surname и lesson.name из таблицы teacher, делаем INNER JOIN с таблицой lesson, где teacher.id = lesson.teacher_id;
SELECT teacher.surname, lesson.name FROM teacher INNER JOIN lesson ON teacher.id = lesson.teacher_id; 

Подадут под выборку и учителя, у которых нет уроков
SELECT teacher.surname, lesson.name FROM teacher LEFT JOIN lesson ON teacher.id = lesson.teacher_id; 


Подадут под выборку и уроки, у которых нет учителей
SELECT teacher.surname, lesson.name FROM teacher RIGHT JOIN lesson ON teacher.id = lesson.teacher_id; 
