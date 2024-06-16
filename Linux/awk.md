## Что это за команда awk?

  
AWK – это скриптовый язык, который полезен при работе в командной строке и широко применяется для обработки текста.  
  
При использовании `awk` вы можете выбирать данные – один или более отдельных фрагментов текста – на основе заданного критерия. Например, с помощью `awk` можно выполнять поиск конкретного слова или шаблона во фрагменте текста, а также выбирать определённую строку/столбец в файле.  
  

### Базовый синтаксис awk

  
Простейшая форма команды `awk` подразумевает описание основного действия в одинарных кавычках и фигурных скобках с указанием после него целевого файла.  
  
Выглядеть она может так:  
  

```
awk '{action}' your_file_name.txt
```

  
Когда вам нужно найти текст, соответствующий конкретному шаблону, или же конкретное слово в тексте, команда принимает следующий вид:  
  

```
awk '/regex pattern/{action}' your_file_name.txt
```

### Создание образца файла

  
Для создания файла в командной строке используется команда `touch`. Например: `touch filename.txt`, где `filename` – это произвольное имя файла.  
  
Затем можно с помощью команды `open` (`open filename.txt`) запустить обработчик текста вроде TextEdit, который позволит внести в файл нужное содержимое.  
  
Предположим, у вас есть текстовый файл _information.txt_, содержащий данные, разделённые по столбцам.  
  
Выглядеть этот файл может так:  
  

```
firstName       lastName        age     city       ID

Thomas          Shelby          30      Rio        400
Omega           Night           45      Ontario    600
Wood            Tinker          54      Lisbon     N/A
Giorgos         Georgiou        35      London     300
Timmy           Turner          32      Berlin     N/A
```

  
В приведённом примере мы видим по одному столбцу для  
`firstName`, `lastName`, `age`, `city` и `ID`.  
  
В любой момент можно просмотреть вывод содержимого вашего файла, выполнив `cat text_file`, где `text_file` представляет имя файла.  
  

### Вывод всего содержимого файла

  
Для вывода всего содержимого файла в качестве действия в фигурных скобках нужно указать `print $0`.  
  
Сработает эта команда аналогично ранее упомянутой `cat`.  
  

```
awk '{print $0}' information.txt
```

  
Вывод:  
  

```
firstName       lastName        age     city       ID

Thomas          Shelby          30      Rio        400
Omega           Night           45      Ontario    600
Wood            Tinker          54      Lisbon     N/A
Giorgos         Georgiou        35      London     300
Timmy           Turner          32      Berlin     N/A
```

  
Если захотите добавить нумерацию строк, то нужно будет дополнить действие переменной `NR`:  
  

```
awk '{print NR,$0}' information.txt
```

  
  

```
1 firstName     lastName        age     city       ID
2
3 Thomas        Shelby          30      Rio        400
4 Omega         Night           45      Ontario    600
5 Wood          Tinker          54      Lisbon     N/A
6 Giorgos       Georgiou        35      London     300
7 Timmy         Turner          32      Berlin     N/A
```

  

### Вывод конкретных столбцов

  
При использовании `awk` можно указывать для вывода конкретные столбцы.  
  
Вывод первого производится следующей командой:  
  

```
awk '{print $1}' information.txt
```

  
Вывод:  
  

```
Thomas
Omega
Wood
Giorgos
Timmy
```

  
Здесь `$1` означает первое поле, то есть в данном случае первый столбец.  
  
Для вывода второго столбца используется `$2`:  
  

```
awk '{print $2}' information.txt
```

  
Вывод:  
  

```
lastName

Shelby
Night
Tinker
Georgiou
Turner
```

  
По умолчанию начало и конец каждого столбца `awk` определяет по пробелу.  
  
Для вывода большего числа столбцов, например, первого и четвёртого, нужно выполнить:  
  

```
awk '{print $1, $4}' information.txt
```

  
Вывод:  
  

```
firstName city
 
Thomas    Rio
Omega     Ontario
Wood      Lisbon
Giorgos   London
Timmy     Berlin
```

  
Здесь `$1` представляет первое поле ввода (первый столбец), а `$4` четвёртое. При этом они отделяются запятой, чтобы вывод разделялся пробелом и был более читаемым.  
  
Для вывода последнего поля (последнего столбца) также можно использовать команду `$NF`, представляющую последнее поле записи:  
  

```
awk '{print $NF}' information.txt
```

  
Вывод:  
  

```
ID

400
600
N/A
300
N/A
```

  

### Вывод конкретных строк столбца

  
Также можно указывать для вывода строку определённого столбца:  
  

```
awk '{print $1}' information.txt | head -1
```

  
Вывод:  
  

```
FirstName
```

  
Разделим эту команду на две части. Сначала `awk '{print $1}' information.txt` выводит первый столбец. Затем её результат (который мы видели выше) с помощью символа `|` передаётся на обработку команде `head`, где аргумент `-1` указывает на выбор первой строки столбца.  
  
Для вывода двух строк команда будет такой:  
  

```
awk '{print $1}' information.txt | head -2
```

  
Вывод:  
  

```
FirstName
Dionysia
```

  

### Вывод строк с заданным шаблоном

  
Вы можете выводить строку, начинающуюся с заданной буквы. Например:  
  

```
awk '/^O/' information.txt
```

  
Вывод:  
  

```
Omega           Night           45      Ontario    600
```

  
Эта команда выбирает все строки с текстом, начинающимся на `O`.  
  
Действие команды начинается с символа `^`, который указывает на начало строки. После этого прописывается буква, с которой нужная вам строка должна начинаться.  
  
По аналогичному принципу можно выводить строку, завершающуюся конкретным шаблоном:  
  

```
awk '/0$/' information.txt
```

  
Вывод:  
  

```
Thomas          Shelby          30      Rio        400
Omega           Night           45      Ontario    600
Giorgos         Georgiou        35      London     300
```

  
Эта команда выводит строки, оканчивающиеся на `0` – здесь с помощью символа `$` мы указываем, как должна заканчиваться нужная строка.  
  
При этом её можно несколько изменить:  
  

```
awk '! /0$/' information.txt 
```

  
Символ `!` используется в качестве приставки «НЕ», а значит, в этом случае будут выбраны строки, которые не оканчиваются на `0`.  
  

```
firstName       lastName        age     city       ID

Wood            Tinker          54      Lisbon     N/A
Timmy           Turner          32      Berlin     N/A
```

  

### Использование регулярных выражений

  
Для вывода слов, содержащих определённые буквы, а также слов, соответствующих указанному шаблону, мы снова используем прямые слэши.  
  
К примеру, если нас интересуют слова, содержащие `io`, мы пишем:  
  

```
awk ' /io/{print $0}' information.txt
```

  
Вывод:  
  

```
Thomas          Shelby          30      Rio        400
Omega           Night           45      Ontario    600
Giorgos         Georgiou        35      London     300
```

  
Мы получили строки, в которых содержатся слова, содержащие `io`.  
  
Теперь предположим, что в файле есть дополнительный столбец `department`:  
  

```
firstName       lastName        age     city       ID   department

Thomas          Shelby          30      Rio        400  IT
Omega           Night           45      Ontario    600  Design
Wood            Tinker          54      Lisbon     N/A  IT
Giorgos         Georgiou        35      London     300  Data
Timmy           Turner          32      Berlin     N/A  Engineering
```

  
Для поиска всей информации о людях, работающих в `IT`, нужно указать искомую строку между `//`:  
  

```
awk '/IT/' information.txt
```

  
Вывод:  
  

```
Thomas          Shelby          30      Rio        400  IT
Wood            Tinker          54      Lisbon     N/A  IT
```

  
А что, если мы хотим увидеть только имена и фамилии сотрудников из `IT`?  
  
Тогда можно указать столбец так:  
  

```
awk '/IT/{print $1, $2}' information.txt
```

  
Вывод:  
  

```
Thomas Shelby
Wood   Tinker
```

  
В этом случае отобразятся только первый и второй столбцы строк, содержащих `IT`.  
  
При поиске слов, содержащих конкретный шаблон, бывают случаи, когда требуется использовать экранирующий символ:  
  

```
awk '/N\/A$/' information.txt
```

  
Вывод:  
  

```
Wood            Tinker          54      Lisbon     N/A
Timmy           Turner          32      Berlin     N/A
```

  
Я хотела найти строки, оканчивающиеся на `N/A`. Поэтому при указании критериев поиска в `' // '`, как это показывалось выше, мне пришлось использовать между `N/A` символ перехода `\`. В противном случае возникла бы ошибка.  
  

### Использование операторов сравнения

  
Если вы, предположим, захотите найти всю информацию о сотрудниках в возрасте до 40 лет, то нужно будет использовать оператор сравнения `<` так:  
  

```
awk '$3 <  40 { print $0 }' information.txt
```

  
Вывод:  
  

```
Thomas          Shelby          30      Rio        400
Giorgos         Georgiou        35      London     300
Timmy           Turner          32      Berlin     N/A
```

  
В выводе представлена информация о людях моложе 40.

### print all file

```
awk '{print $0}' file
```

### print first word from each line

```
awk '{print $1}' file
```

### show column by delimeter

```
awk -F: '{print $1}' /etc/passwd
```

### change word

```

echo "One Two" | awk '{$2="Three";print $0}'
```

### print table 2 columns with title
```
FS - like -F choose delimiter
awk 'BEGIN {print "login \t home"; FS=":"} {print $1 "\t" $6}' /etc/passwd

OFS - change delimiter in output
awk 'BEGIN {FS=":"; OFS="/"} {print $1, $3, $6}' /etc/passwd
```


### Get file name from path
```
$NF - show last column
  echo $file_path | awk 'BEGIN{FS="/"}{print $NF}' | xclip -sel clip
```

### Arguments
```
ARGC - argument count
ARGV - argument value, [0] - argument, [1] - file
awk 'BEGIN {print ARGC, ARGV[1]}' /etc/passwd
awk 'BEGIN {print ENVIRON["HOME"]}' - show home directory path
```
