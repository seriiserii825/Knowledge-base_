### select

```
select car in BMW MERCEDES TESLA ROVER TOYOTA
do
  case $car in
    BMW)
      echo "BMW SELECTED";;
    MERCEDES)
      echo "MERCEDES SELECTED";;
    TESLA)
      echo "TESLA SELECTED";;
    ROVER)
      echo "ROVER SELECTED";;
    TOYOTA)
      echo "TOYOTA SELECTED";;
    *)
      echo "ERROR! Please select between 1..5";;
  esac
done
```

### default value
```

defaultOption="php" # Set the default option here
read -p "Select an option (php/scss/js/vue), by default is php: " choice
if [ -z "$choice" ]; then
  choice=$defaultOption
  echo "Default option selected: $choice"
fi

case $choice in
  php)
    phpCreate
    scssCreate
    echo "$file_path was created";
    ;;
  scss)
    echo "Selected: $choice"
    scssCreate
    echo "$file_path was created";
    ;;
  js)
    echo "Selected: $choice"
    jsCreate 
    echo "$file_path was created";
    ;;
  vue)
    echo "Selected: $choice"
    vueCreate 
    echo "$file_path was created";
    ;;
  *)
    echo "Invalid option selected"
    ;;
esac

```
