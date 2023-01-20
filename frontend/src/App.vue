<template>
  <div id="app">

    <!-- Router View Start -->
    <router-view></router-view>
    <!-- Router View End -->

  </div>
</template>


<script>

  export default {
    components: {},
        mounted(){
            window.scrollTo(0,0);
        }
   

  }
</script>