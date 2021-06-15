router.get('/admin/logout', (req, res) => {
  req.session.destroy((error) => {
    if (error) {
      res.redirect('/amin');
    } else {
      res.redirect('/admin/login');
    }
  });
});
