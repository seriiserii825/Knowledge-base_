<div id="app">
    <h1>{{ title }} = {{ counter }}</h1>
    <button v-on:click="riseCounter(5, 'Count to 5', $event)">Rise counter 5</button>
    <button v-on:click="riseCounter(10, 'Count to 10', $event)">Rise counter 10</button>

</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            counter: 0,
            title: "Counter"
        },
        methods: {
        	riseCounter(num, str, event){
        		this.counter += num
        		this.title = str
                if(num === 5){
					event.target.style.color = 'green';
				}else if(num === 10){
					event.target.style.color = 'blue';
				}
			},
		}
    });
</script>
