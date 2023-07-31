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
