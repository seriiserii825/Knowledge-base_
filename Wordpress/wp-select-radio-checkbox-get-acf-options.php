<?php
// Получить все варианты (choices) ACF-поля checkbox/radio/select.
// Работает одинаково для всех трёх типов — ACF хранит варианты
// в одном и том же ключе 'choices' независимо от типа поля.

// Вариант 1: поле лежит внутри repeater, который лежит внутри group
// (например group('staff') > repeater('items') > checkbox('category'))
function acf_get_repeater_field_choices(string $parent_name, string $repeater_name, string $field_name): array
{
  $parent_field = get_field_object($parent_name);
  if (!$parent_field) {
    return [];
  }

  $repeater_field = array_column($parent_field['sub_fields'], null, 'name')[$repeater_name] ?? null;
  if (!$repeater_field) {
    return [];
  }

  $target_field = array_column($repeater_field['sub_fields'], null, 'name')[$field_name] ?? null;

  return $target_field['choices'] ?? [];
}

// Вариант 2: поле лежит внутри group напрямую, без repeater
// (например group('staff') > checkbox('some_field'))
function acf_get_group_field_choices(string $group_name, string $field_name): array
{
  $group_field = get_field_object($group_name);
  if (!$group_field) {
    return [];
  }

  $target_field = array_column($group_field['sub_fields'], null, 'name')[$field_name] ?? null;

  return $target_field['choices'] ?? [];
}

// Вариант 3: поле — обычное top-level поле (не вложено ни во что)
function acf_get_field_choices(string $field_name): array
{
  $field = get_field_object($field_name);

  return $field['choices'] ?? [];
}

// Использование:
// $category_options = acf_get_repeater_field_choices('staff', 'items', 'category');
// $some_options = acf_get_group_field_choices('staff', 'some_field');
// $status_options = acf_get_field_choices('status');
//
// foreach ($category_options as $value => $label) {
//   echo $label;
// }

// Альтернатива, если уже внутри цикла have_rows()/the_row() репитера —
// там get_sub_field_object() резолвит имя поля само, без обхода sub_fields:
//
// if (have_rows('items')) :
//   while (have_rows('items')) : the_row();
//     $selected = get_sub_field('category') ?: [];
//     $field = get_sub_field_object('category');
//     $all_choices = $field['choices'] ?? [];
//   endwhile;
// endif;
