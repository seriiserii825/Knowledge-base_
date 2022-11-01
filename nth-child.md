# Basically, the 3n means "every third" while +2 means "starting with number two".

:nth-child(3n+2) {
// your css rules here
}

# Select All But The First Five

li:nth-child(n+6) {
color: green;  
}

# Select Only The First Five

li:nth-child(-n+5) {
color: green;  
}

# Select the Second to Last Element

li:nth-last-child(2) {
    color: green;
}
