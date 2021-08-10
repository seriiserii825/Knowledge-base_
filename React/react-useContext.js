#hooks/Context.js

import React, { createContext, useState } from 'react';

export const CustomContext = createContext();

export const Context = (props) => {
  const [books, setBooks] = useState([
    { id: 1, title: 'Js' },
    { id: 2, title: 'React' },
    { id: 3, title: 'Nodejs' },
  ]);

  const addBook = (book) => {
    setBooks([book, ...books]);
  }

  const removeBook = (id) => {
    const newBooks = books.filter(book => book.id !== id);
    setBooks([...newBooks]);
  }

  const value = {
    books,
    addBook,
    removeBook
  }

  return (
    <CustomContext.Provider value={value}>
      {props.children}
    </CustomContext.Provider>
  )
}

#App.js
import "./App.css";
import { Context } from "./hooks/Context";
import { Books } from "./components/Books";

function App() {
  return (
    <Context>
      <Books/>
    </Context>
  );
}

export default App;

#components/Books.js

import React, { useContext, useState } from 'react';
import { CustomContext } from "../hooks/Context";

const Books = () => {
  const { books, removeBook, addBook } = useContext(CustomContext);
  const [title, setTitle] = useState('');
  const addNewBook = () => {
    if (title !== '') {
      const newBook = { id: +new Date(), title: title };
      addBook(newBook);
      setTitle('');
    }
  }
  return (
    <div className="list=books">
      <ul className="books">
        {books.map((book) => (
          <li key={book.id}>
            <h4>{book.title}</h4>
            <button className="btn" onClick={() => removeBook(book.id)}>Remove</button>
          </li>
        ))}
      </ul>
      <div className="add-book">
        <input type="text" name="title" value={title} onChange={(e) => setTitle(e.target.value)}/>
        <button className="btn" onClick={addNewBook}>Add book</button>
      </div>
    </div>
  );
};

export { Books };
