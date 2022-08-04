import { useState } from "react"

const allToppings = [
  { name: "Golden Corn", checked: false },
  { name: "Paneer", checked: false },
  { name: "Tomato", checked: false },
  { name: "Mushroom", checked: false },
  { name: "Onion", checked: false },
  { name: "Black Olives", checked: false },
]

export const Checkbox = ({ isChecked, label, checkHandler, index }) => {
  console.log({ isChecked })
  return (
    <div>
      <input
        type="checkbox"
        id={`checkbox-${index}`}
        checked={isChecked}
        onChange={checkHandler}
      />
      <label htmlFor={`checkbox-${index}`}>{label}</label>
    </div>
  )
}

function App() {
  const [toppings, setToppings] = useState(allToppings)

  const updateCheckStatus = index => {
    setToppings(
      toppings.map((topping, currentIndex) =>
        currentIndex === index
          ? { ...topping, checked: !topping.checked }
          : topping
      )
    )
  }

  const selectAll = () => {
    setToppings(toppings.map(topping => ({ ...topping, checked: true })))
  }
  const unSelectAll = () => {
    setToppings(toppings.map(topping => ({ ...topping, checked: false })))
  }

  return (
    <div className="App">
      <p>
        <button onClick={selectAll}>Select All</button>
        <button onClick={unSelectAll}>Unselect All</button>
      </p>

      {toppings.map((topping, index) => (
        <Checkbox
          key={topping.name}
          isChecked={topping.checked}
          checkHandler={() => updateCheckStatus(index)}
          label={topping.name}
          index={index}
        />
      ))}
      <p>
        <pre>{JSON.stringify(toppings, null, 2)}</pre>
      </p>
    </div>
  )
}

export default App
