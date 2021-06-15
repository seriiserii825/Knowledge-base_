    const user = await Admin.create({
      name: 'Test name',
      email: 'serii@mail.ru',
      password: bcrypt.hashSync('1234', 10)
    });


  if (user) {
    bcrypt.compare(req.body.password, user.password, (error, result) => {
      if (result) {
        req.flash('success', 'User is logged in');
        req.session.isLoggedIn = true;
        req.session.userId = user.id;
        res.redirect('/admin');
      } else {
        req.flash('error', 'Invalid credentials');
        res.redirect('/admin/login');
      }
    })
  } else {
    req.flash('error', 'Invalid email');
    res.redirect('/admin/login');
  }
