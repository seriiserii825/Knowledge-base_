.page-portfolio__wrap
  .page-portfolio__posts
  .page-portfolio__terms
    .term-list

  function stickyTermList() {
    const bottomSpace = $(".main-footer").outerHeight() + 100;
    $(".term-list").sticky({
      topSpacing: 60,
      bottomSpacing: bottomSpace,
    });
  }

  const pagePortfolioPosts = $(".page-portfolio__posts");
  const termListParent = $(".page-portfolio__terms");
  if (pagePortfolioPosts.outerHeight() > termListParent.outerHeight()) {
    stickyTermList();
  }
