#=== date.filter.js
export default function dateFilter(value, format = 'date') {
  const options = {}
  
  if (format.includes('date')) {
    options.day = '2-digit'
    options.month = 'long'
    options.year = 'numeric'
  }
  if (format.includes('time')) {
    options.hour = '2-digit'
    options.minute = '2-digit'
    options.second = '2-digit'
  }
  
  return new Intl.DateTimeFormat('ru-RU', options).format(new Date(value))
}

### nav script
import dateFilter from "../../filters/date.filter";

export default {
  setup() { // using the composition API
    return {
      dateFilter
    }
  }
}
<template>
        <span class="black-text">{{ dateFilter(date, 'date') }}</span>
</template>
