#title
Это главный мета тэг на странице
Он должен описасть содержание страницы, а не просто "Главная"
Он не должен дублироваться. 

title, description, h1 должны быть уникальными на всем сайте. 
Не индексировать сайт, пока он не будет готов. 

#rel-canonical
Просто супер важно!!!!
in layout, and in the post-type page
head(){
        return {
                link: [
                        {rel: "canonical", href:"`http://localhost:3000${this.$route.path}`"}
                ]
        }
}

  head(){
    return {
      title: "Home page",
      meta: [
        {hid: "description", name: "description", content: "Description for home page"},
        {hid: "robots", name: "robots", content: "noindex,nofollow"},
      ]
    }
  },
