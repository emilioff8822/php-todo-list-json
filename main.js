const { createApp} = Vue;


createApp({
  data(){
    return{

    }
  },
  methods:{
    getApi(){
      axios.get('server.php') 
      .then(result => {
        console.log(result.data);
      })
    }
  },
  mounted(){
    this.getApi();
  }










}).mount('#app');