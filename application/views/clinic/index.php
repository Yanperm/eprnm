<div id="app">
    <h1>{{ name }}</h1>

</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    var app = new Vue({
        el : "#app",
        data : {
            name : "VUE",
            "message" : "HI"
        },
        method : {
            sendMessage : function (){
                return this.message = "I am sick";
            }
        }
    })
</script>
