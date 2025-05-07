
# -a флаг создает my_array индексированный массив.
declare -a my_array=("apple" "banana" "cherry")

# Чтобы распечатать весь массив целиком, вы можете использовать:
echo "${my_array[@]}"

# Для доступа к отдельным элементам из массива:
echo "${my_array[0]}" # Вывод: яблоко
echo "${my_array[1]}" # Вывод: банан
echo "${my_array[2]}" # Вывод: вишня

# Перебор по массиву:
for item in "${my_array[@]}"; do
    echo "$item"
done

# Получение длины массива:
echo "${#my_array[@]}" # Вывод: 3

# Добавление нового элемента:
my_array+=("date")
echo "${my_array[@]}" # Вывод: яблоко банан вишня дата

# Удаление элемента:
# Чтобы удалить второй элемент (banana по индексу 1):
unset my_array[1]
echo "${my_array[@]}" # Вывод: яблоко вишня дата

# 3.4. Задайте переменную в виде ассоциативного массива (Bash 4+)
declare -A my_assoc_array=([fruit]="apple" [color]="red")

# В Bash это создаёт ассоциативный массив (также называемый словарём или хэш-картой), в котором ключи (вместо числовых индексов) сопоставляются с определёнными значениями.
# -Aфлаг создает my_assoc_array ассоциативный массив (пары ключ-значение).
# Доступ к элементам:
echo "${my_assoc_array[fruit]}" # Вывод: яблоко
echo "${my_assoc_array[color]}" # Вывод: красный

# Печать всех Ключей:
echo "${!my_assoc_array[@]}" # Вывод: цвет плода

# Печать всех значений:
echo "${my_assoc_array[@]}" # Вывод: яблоко красное

# Перебор по массиву:
for key in "${!my_assoc_array[@]}"; do
    echo "$key => ${my_assoc_array[$key]}"
done

# Добавление новой пары Ключ-значение:
my_assoc_array[shape] = "circle"; 
echo "${!my_assoc_array[@]}"; # Вывод: цвет плода форма 
echo "${my_assoc_array[shape]}"; # Вывод: круг

# Извлечение ключа
unset my_assoc_array[цвет]
echo "${!my_assoc_array[@]}" # Вывод: форма плода

# sum array
local all_plugins=("${local_plugins[@]}" "${server_plugins[@]}")

# diff 2 arrays
local all_plugins=("${local_plugins[@]}" "${server_plugins[@]}")
local installed_plugins=($(getInstalledPlugins))
local plugins_to_install=($(echo ${all_plugins[@]} ${installed_plugins[@]} | tr ' ' '\n' | sort | uniq -u))

# check in array
[[ ${result[*]} =~ "All" ]] && echo "${all_choices[@]}" || echo "${result[@]}"

# Example usage
add_object_to_array "Title1" "Text1"
add_object_to_array "Title2" "Text2"
add_object_to_array "Title3" "Text3"

# Print the array elements
for ((i = 0; i < ${#titles[@]}; i++)); do
  echo "Title: ${titles[i]}, Text: ${texts[i]}"
done

os=('ubuntu' 'windows' 'kali')
echo "${os[@]}" # print all elements
echo "${!os[@]}" # print all indexes
echo "${#os[@]}" # print length of array
os[3]='mac' # add element at index 3
unset os[2] # remove element at index 2

# unassociative array
declare -A car
car[BMW]=i8
car[Toyota]=corolla
car[Mercedes]=c300
echo "${car[Toyota]}"

### associative

#!/bin/bash
