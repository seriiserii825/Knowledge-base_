### case

```
echo -n "Enter the name of a country: "
read COUNTRY

echo -n "The official language of $COUNTRY is "

case $COUNTRY in

  Russia)
    echo -n "Russian"
    ;;

  Romania | Moldova)
    echo -n "Romanian"
    ;;

  Italy | "San Marino" | Switzerland | "Vatican City")
    echo -n "Italian"
    ;;

  *)
    echo "unknown"
    ;;
esac

```
