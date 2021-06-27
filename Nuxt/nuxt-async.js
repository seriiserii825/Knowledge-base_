asyncData(context, callback){
        setTimeout(()=>{
                        callback(null, {
                                   loadedPosts: [{id:1, title 'some'}, {id:2, title: 'second'}] 
                           })
        }, 2000);
        
}
