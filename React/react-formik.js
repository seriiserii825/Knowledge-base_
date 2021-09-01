import React from 'react';
import { Formik } from 'formik'
import * as yup from 'yup'
import './App.scss'


function App() {
  const validationsSchema = yup.object().shape({
    name: yup.string().typeError('Должно быть строкой').required('Обязательно'),
    secondName: yup.string().typeError('Должно быть строкой').required('Обязательно'),
    password: yup.string().typeError('Должно быть строкой').required('Обязательно'),
    confirmPassword: yup.string().oneOf([yup.ref('password')], 'Пароли не совпадают').required('Обязательно'),
    email: yup.string().email('Введите верный email').required('Обязательно'),
    confirmEmail: yup.string().email('Введите верный email').oneOf([yup.ref('email')], 'Email не совпадают').required('Обязательно')
  })

  return (
    <div>
      <Formik
        initialValues={{
          name: '',
          secondName: '',
          password: '',
          confirmPassword: '',
          email: '',
          confirmEmail: ''
        }}
        validateOnBlur
        onSubmit={(values) => { console.log(values) }}
        validationSchema={validationsSchema}
      >
        {({ values, errors, touched, handleChange, handleBlur, isValid, handleSubmit, dirty }) => (
          <div className={<code>from</code>}>
            <p>
              <label htmlFor={<code>name</code>}>Имя</label><br />
              <input
                className={'input'}
                type={<code>text</code>}
                name={<code>name</code>}
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.name}
              />
            </p>
            {touched.name && errors.name && <p className={'error'}>{errors.name}</p>}
            <p>
              <label htmlFor={<code>secondName</code>}>Фамилия</label><br />
              <input
                className={'input'}
                type={<code>text</code>}
                name={<code>secondName</code>}
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.secondName}
              />
            </p>
            {touched.secondName && errors.secondName && <p className={'error'}>{errors.secondName}</p>}
            <p>
              <label htmlFor={<code>secondName</code>}>Пароль</label><br />
              <input
                className={'input'}
                type={<code>password</code>}
                name={<code>password</code>}
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.password}
              />
            </p>
            {touched.password && errors.password && <p className={'error'}>{errors.password}</p>}

            <p>
              <label htmlFor={<code>confirmPassword</code>}>Подтвердите пароль</label><br />
              <input
                className={'input'}
                type={<code>password</code>}
                name={<code>confirmPassword</code>}
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.confirmPassword}
              />
            </p>
            {touched.confirmPassword && errors.confirmPassword && <p className={'error'}>{errors.confirmPassword}</p>}

            <p>
              <label htmlFor={<code>email</code>}>Email</label><br />
              <input
                className={'input'}
                type={<code>email</code>}
                name={<code>email</code>}
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.email}
              />
            </p>
            {touched.email && errors.email && <p className={'error'}>{errors.email}</p>}

            <p>
              <label htmlFor={<code>confirmEmail</code>}>Подтвердите email</label><br />
              <input
                className={'input'}
                type={<code>email</code>}
                name={<code>confirmEmail</code>}
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.confirmEmail}
              />
            </p>
            {touched.confirmEmail && errors.confirmEmail && <p className={'error'}>{errors.confirmEmail}</p>}

            <button
              disabled={!isValid || !dirty}
              onClick={handleSubmit}
              type={<code>submit</code>}
            >Отправить</button>
          </div>
        )}
      </Formik>
    </div>
  );
}

export default App;
