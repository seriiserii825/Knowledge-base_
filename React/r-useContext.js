//================ App.js
import {RUseContext} from "./books/RUseContext";
import {AllBooks} from "./books/AllBooks";


function App(){
  return(
    <RUseContext>
      <AllBooks/>
    </RUseContext>
    )
}

export default App





//================= RUseContext

import React, { useState, createContext } from "react";

export const CustomContext = createContext();

//Получаем props
function RUseContext(props) {
  const [books, setBooks] = useState([
    { id: 1, title: "Jsx" },
    { id: 2, title: "React" },
  ]);

  function addBook(book) {
    setBooks([book, ...books]);
  }

  function removeBook(id) {
    setBooks(books.filter((item) => item.id !== id));
  }

  const value = {
    books,
    addBook,
    removeBook
  }

  return <CustomContext.Provider value={value}>
    {props.children}
    </CustomContext.Provider>


//============ AllBooks
   import React, {useContext} from "react"
  import CustomContext from "./CustomContext";
  import Book from "./Book"

   function AllBooks(){
     const {books} = useContext(CustomContext);
     return(
       <div className="all-books">
         {books.map(item => {
           return (<Book/>)
         })}
       </div>
       )
   }

export default AllBooks; 

